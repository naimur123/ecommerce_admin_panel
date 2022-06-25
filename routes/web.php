<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.masterPage');
});

// Auth::routes();

// Route::get('/admin/login',[HomeController::class, 'showloginform'])->name('admin.login');
Route::get('/admin/login',[AdminController::class, 'showloginform']);
Route::post('/admin/login',[AdminController::class, 'login'])->name('admin.login');
Route::middleware(["admin"])->group(function(){

    Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('home',[AdminController::class, 'dashboard'])->name('home');
    Route::post('logout',[AdminController::class, 'logout'])->name('logout');

    // Products
    Route::get('products',[ProductController::class, 'index'])->name('products');

    });
});

// Route::get('/home', [HomeController::class, 'index']);
