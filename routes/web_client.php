<?php

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

Route::get('/register',[LoginController::class,'showRegisterform'])->name('user.register');
Route::get('/register/google',[LoginController::class,'redirectToGoogle'])->name('register.google');
Route::get('/register/google/signin',[LoginController::class,'googleSignin'])->name('register.google.signin');
Route::get('/user/dashboard/{id}',[DashboardController::class,'index'])->name('user.dashboard');

//Add to cart
Route::get('/cart',[HomeController::class,'cart'])->name('cart');
Route::get('/addTocart/{id}',[HomeController::class,'addTocart'])->name('addtocart');
Route::get('/cart/delete/{id}',[HomeController::class,'cartDelete'])->name('cart.delete');