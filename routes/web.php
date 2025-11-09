<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front_end.login');
})->name('login');


Route::get('/register',[AuthController::class,'index'])->name('user.register');
Route::post('/register',[AuthController::class,'store'])->name('user.saved');
