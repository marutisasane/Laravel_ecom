<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class verification extends Controller
{
    public function index($token)
    {
       $user = User::where('verification_token',$token)->first();

       if ($user == null)
        {
            $message = "You are already verified";
            return view('mail.verifactionPage' ,compact('message','user'));
       }

       if ($user->token_expires_at < Carbon::now())
        {
            $token_status = 0;
            $message = "Token expired pls reganerate new";
            return view('mail.verifactionPage' ,compact('message','user','token_status'));
        }

            $user->is_verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->verification_token = null;
            $user->token_expires_at = null;
            $user->save();
            $token_status = 1;
            $message = "User verification done successfully Pls login";
            return view('mail.verifactionPage' ,compact('message','user','token_status'));


    }


    public function token_regenerate($id)
    {
        $user = User::find($id);
        $user->verification_token      =   Str::random(60);
        $user->token_expires_at      =   Carbon::now()->addHour();
        $user->save();

        $token = url('verify/'.$user->verification_token);

        return view('mail.userMail',compact('token','user'));
    }
}
