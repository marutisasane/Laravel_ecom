<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('layout.app');
    }

    public function logout()
    {
        Auth::logout();
        session()->flash('success',"logout Successfully");
        return response()->json([
                'status' => true,
                "message" => "logout Successfully"
        ]);

    }
}
