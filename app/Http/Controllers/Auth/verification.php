<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class verification extends Controller
{
    public function index($token)
    {
       $user = User::where('verification_token',$token)->first();

       if ($user != null)
        {
            return response()->json([
                'status' => false,
                'message' => "token not found"
            ]);
       }

       if ($user->token_expires_at < Carbon::now())
        {
            $message = "Token expired pls ganerate new ";
            return view('mail.userMail',compact('message'));
        }

            $user->is_verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->verification_token = null;
            $user->token_expires_at = null;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => "Verification successfull"
            ]);


    }
}
