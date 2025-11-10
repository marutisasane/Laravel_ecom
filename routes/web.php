<?php

use App\Http\Controllers\Admin\HomeController;
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
Route::get('token_regenerate/{id}',[verification::class,'token_regenerate'])->name('token_regenerate');

Route::get('/password-forgot',[AuthController::class,'passwordForgotView'])->name('password-forgot.view');
Route::post('/password-forgot',[AuthController::class,'passwordForgot'])->name('password-forgot');

Route::get('reset-password/{token}',[AuthController::class,'resetPasswordView'])->name('reset-password.view');
Route::post('reset-password/',[AuthController::class,'resetPassword'])->name('reset-password');



Route::get('dashboard',[HomeController::class,'index'])->name('dashboard');
Route::get('/logout',[HomeController::class,'logout'])->name('user.logout');


