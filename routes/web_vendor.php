<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Vendor\Auth\RegisterController;
use App\Http\Controllers\Vendor\Auth\LoginController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\VendorProductController;
use Illuminate\Support\Facades\Route;

Route::get('/vendor/login',[LoginController::class, 'showloginform'])->name('vendor.login.page');
Route::post('/vendor/login',[LoginController::class, 'login'])->name('vendor.login');
Route::get('/vendor/register',[RegisterController::class, 'showregisterform']);
Route::post('/vendor/register',[RegisterController::class, 'create'])->name('vendor.regsiter');

Route::middleware(['auth:vendor','approved'])->group(function(){

    Route::prefix('vendor')->name('vendor.')->group(function(){

        Route::get('home',[LoginController::class, 'dashboard'])->name('home');
        Route::get('logout',[LoginController::class, 'loggedOut'])->name('logout');

        //Orders
        Route::prefix('orders')->group(function(){
            Route::get('',[OrderController::class,'index'])->name('order.list');
        });

        // Products
        Route::prefix('products')->group(function(){

            // Route::get('',[VendorProductController::class, 'index'])->name('products');
            Route::get('/create',[VendorProductController::class, 'create'])->name('products.create');
            Route::post('/create',[VendorProductController::class, 'store'])->name('products.store');
            Route::get('/getSubcategory', [CategoryController::class, 'getSubcategory'])->name('category.subcategory');
            // Route::get('/update/{id}',[VendorProductController::class, 'edit'])->name('products.edit');
            // Route::post('/update',[VendorProductController::class, 'store'])->name('products.store');
        });
    });


});