<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegister;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Requests\Auth\registrationRequest;
use App\Jobs\sendEmailToNewUser;
use App\Mail\passwordResetMail;
use App\Mail\SendUserRegistrationNotification;
use App\Models\password_reset_tokens;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('front_end.register');
    }

    public function store(registrationRequest $request)
    {
        try
        {
            $user =new User();
            $user->name      =   $request->name;
            $user->email      =   $request->email;
            $user->country_code      =   $request->code;
            $user->phone_no      =   $request->phone_no;
            $user->password      =   $request->password;
            $user->verification_token      =   Str::random(60);
            $user->token_expires_at      =   Carbon::now()->addHour();
            $user->save();


            $token = url('verify/'.$user->verification_token);

            // sendEmailToNewUser::dispatch($user,$token);  // Queue for send mail
            UserRegister::dispatch($user,$token);  // event for send mail

            session()->flash('success' , "User Added successfully");
            return response()->json([
                'status'    => true,
                'message'   => "User Added successfully",
                'data'      => $user,
            ]);

        }
        catch (\Exception $e)
        {
            session()->flash('error' ,"Error occured while adding user");
            return response()->json([
                'status' =>     false,
                'message'  =>     $e->getMessage(),
            ]);
        }

    }

    public function login()
    {
        return view('front_end.login');
    }

    public function authentication(AuthRequest $request)
    {
        $credentials = $request->validated();

        $key = 'login-attempts:' . Str::lower($request->email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'status' => false,
                'message' => "Too many login attempts. Try again in $seconds seconds.",
            ], 429);
        }
        // If login fails, increment attempts
        RateLimiter::hit($key, $decaySeconds = 60); // lock for 60s



        if (Auth::attempt($credentials))
        {
            $user = User::where('email',$request->email)->first();

            if (Auth::user()->is_verified == "0")
            {
                session()->flash('error',"'Pls verify your account before login'");
                return response()->json([
                    'status' => false,
                    'message'  => 'Pls verify your account before login'
                ]);
            }

            RateLimiter::clear($key);
            $request->session()->regenerate();

            session()->flash('success',"You are login successfully");

            return response()->json([
                'status'    => true,
                'message'   => "You are login successfully",

            ],200);
        }
        else
        {
            session()->flash('error',"Email id and password mismatched");

            return response()->json([
                'status'    => false,
                'message'   => "Email id and password mismatched",
            ],401);
        }
    }


    public function passwordForgotView()
    {
        return view('front_end.forgot_password');
    }


    public function passwordForgot(Request $request)
    {
        $validator = Validator::make($request->only('email'),[
            'email' => 'required|email'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ],422);
        }

        $user = User::where('email',$request->email)->first();
        // dd($user);die;
        if ($user == null)
        {
            session()->flash('error',"Email not found ");
            return response()->json([
                'status'  => false,
                'message'   => "Email not found"
            ]);
        }

        $token = Str::random(60);
        $url = url("/reset-password")."/".$token;

        $password_reset_tokens = PasswordReset::where('email',$request->email)->first();

        PasswordReset::updateOrCreate(
                ['email' => $request->email],
                [
                    'token'      => $token,
                    'created_at' => Carbon::now(),
                ]
            );



        Mail::to($request->email)->send(new passwordResetMail($url,$user));

        session()->flash('success',"Email send on mail successfully ");
        return response()->json([
            'status'  => true,
            'message' => "Email send on mail successfully ",
        ]);
    }

    public function resetPasswordView($token)
    {
        $userData = PasswordReset::where('token',$token)->first();

        if (!$userData)
        {
            return abort(404,"Something went wrong");
        }

        $user = User::where('email',$userData->email)->first();

        return view('front_end.reset_password', compact('user'));
    }


    public function  resetPassword(Request $request)
    {
        $user = User::find($request->id);

         $validator = Validator::make($request->all(),[
            'password' => 'required|confirmed',
            'id'       => 'required',

        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ],422);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where('email',$user->email)->delete();

        session()->flash('success',"Password updated successfully");

        return response()->json([
                'status' => true,
                'message' => "Password updated successfully",
            ],200);
    }
}
