<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('home');

// User Login With google
// Route::controller(LoginController::class)->group(function(){
//     Route::get('auth/google', 'redirectToGoogle');
//     Route::get('auth/callback', 'googleCallback');
// });


Route::get('/register/google',[LoginController::class,'redirectToGoogle'])->name('register.google');
Route::get('/register/google/signin',[LoginController::class,'googleSignin'])->name('register.google.signin');

Route::get('/login',[LoginController::class,'index'])->name('user.showLoginform');
Route::post('/login',[LoginController::class,'login'])->name('user.login');
Route::get('/register',[LoginController::class,'showRegisterform'])->name('user.registerForm');
Route::post('/register',[LoginController::class,'register'])->name('user.register');

//Email verify
Route::get('/email/verfiy/{id}',[LoginController::class,'verifyNotification'])->name('email.verfiy');
Route::get('/email/verifiy/{token}/{id}',[LoginController::class,'verify'])->name('email.verified');



Route::get('/user/dashboard/{id}',[LoginController::class,'dashboard'])->name('user.dashboard');

//Add to cart
Route::get('/cart',[HomeController::class,'cart'])->name('cart');
Route::get('/addTocart/{id}',[HomeController::class,'addTocart'])->name('addtocart');
Route::get('/cart/delete/{id}',[HomeController::class,'cartDelete'])->name('cart.delete');