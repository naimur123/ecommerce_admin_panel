<?php

use App\Http\Controllers\Vendor\Auth\LoginController;
use App\Http\Controllers\Vendor\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/vendor/login',[LoginController::class, 'showloginform']);
Route::post('/vendor/login',[LoginController::class, 'login'])->name('vendor.login');

Route::middleware(["auth:vendor"])->group(function(){

    Route::prefix('vendor')->name('vendor.')->group(function(){

        Route::get('home',[LoginController::class, 'dashboard'])->name('home');
        Route::get('logout',[LoginController::class, 'logout'])->name('logout');

        //Orders
        Route::prefix('orders')->group(function(){
            Route::get('',[OrderController::class,'index'])->name('order.list');
        });
    });


});