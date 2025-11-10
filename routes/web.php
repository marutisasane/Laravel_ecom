<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\verification;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front_end.login');
})->name('login');


Route::get('/register',[AuthController::class,'index'])->name('user.register');
Route::post('/register',[AuthController::class,'store'])->name('user.saved');

Route::get('/login',[AuthController::class,'login'])->name('user.login');
Route::post('/authenticate',[AuthController::class,'authentication'])->name('user.auth');

Route::get('verify/{token}',[verification::class,'index'])->name('verify.token');
