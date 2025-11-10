<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Requests\Auth\registrationRequest;
use App\Jobs\sendEmailToNewUser;
use App\Mail\SendUserRegistrationNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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

            sendEmailToNewUser::dispatch($user,$token);

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
}
