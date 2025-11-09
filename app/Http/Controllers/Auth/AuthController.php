<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('front_end.register');
    }

    public function store(Request $request)
    {
        return $request->all();
    }
}
