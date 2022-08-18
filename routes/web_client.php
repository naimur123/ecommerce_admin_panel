<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\OrderController;
use Illuminate\Support\Facades\Route;

// Route::get('/link',[HomeController::class,'link']);
Route::get('/',[HomeController::class,'index'])->name('home');

// User Login With google
// Route::controller(LoginController::class)->group(function(){
//     Route::get('auth/google', 'redirectToGoogle');
//     Route::get('auth/callback', 'googleCallback');
// });


Route::get('/register/google',[LoginController::class,'redirectToGoogle'])->name('register.google');
Route::get('/register/google/signin',[LoginController::class,'googleSignin'])->name('register.google.signin');

//User login and register and logout
Route::get('/login',[LoginController::class,'index'])->name('user.showLoginform');
Route::post('/login',[LoginController::class,'login'])->name('user.login');
Route::get('/register',[LoginController::class,'showRegisterform'])->name('user.registerForm');
Route::post('/register',[LoginController::class,'register'])->name('user.register');
Route::get('/logout',[LoginController::class,'logout'])->name('user.logout');

//Email verify
Route::get('/email/verfiy/{id}',[LoginController::class,'verifyNotification'])->name('email.verfiy');
Route::get('/email/verifiy/{token}/{id}',[LoginController::class,'verify'])->name('email.verified');



Route::get('/user/dashboard/{id}',[LoginController::class,'dashboard'])->name('user.dashboard');

//Add to cart
Route::get('/cart',[HomeController::class,'cart'])->name('cart');
Route::get('/addTocart/{id}',[HomeController::class,'addTocart'])->name('addtocart');
Route::post('/update/cart',[HomeController::class,'cartUpdate'])->name('cart.update');
Route::get('/cart/delete/{id}',[HomeController::class,'cartDelete'])->name('cart.delete');
Route::get('/cart/checkout',[HomeController::class,'checkout'])->name('cart.checkout');

//Order Controller
Route::post('/user/address',[OrderController::class,'storeAddress'])->name('address.store');
Route::get('/pay/cash',[OrderController::class,'cashview'])->name('pay.cash');
Route::post('/pay/cash',[OrderController::class,'cashstore'])->name('pay.cash.store');
// Route::get('/pay/online',[OrderController::class,'onlineview'])->name('pay.online');
// Route::post('/pay/online',[OrderController::class,'onlinestore'])->name('pay.online.store');
// Route::post('/pay-via-ajax', [OrderController::class, 'payViaAjax']);
// Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
// Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

// Route::post('/success', [SslCommerzPaymentController::class, 'success']);
// Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
// Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'onlineview'])->name('easy.checkout');
// Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

// Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay', [SslCommerzPaymentController::class, 'payViaAjax']);
