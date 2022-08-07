<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GenericStatusController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\User\LoginController;

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

// Route::get('/', function () {
//     return "Hello Word";
// });

// Auth::routes();

// Route::get('/admin/login',[HomeController::class, 'showloginform'])->name('admin.login');
Route::get('/admin/login',[AdminController::class, 'showloginform']);
Route::post('/admin/login',[AdminController::class, 'login'])->name('admin.login');
Route::middleware(["admin"])->group(function(){

    Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('home',[AdminController::class, 'dashboard'])->name('home');
    Route::get('logout',[AdminController::class, 'logout'])->name('logout');

     // Generic Status
     Route::get('status',[GenericStatusController::class, 'index'])->name('status');
     Route::get('/status/create',[GenericStatusController::class, 'create'])->name('status.create');
     Route::post('/status/create',[GenericStatusController::class, 'store'])->name('status.store');
     Route::get('/status/update/{id}',[GenericStatusController::class, 'edit'])->name('status.edit');
     Route::post('/status/update',[GenericStatusController::class, 'store'])->name('status.store');
     Route::get('/status/delete/{id}',[GenericStatusController::class, 'delete'])->name('status.delete');


     // Category
     Route::get('/category',[CategoryController::class, 'index'])->name('category');
     Route::get('/category/create',[CategoryController::class, 'create'])->name('category.create');
     Route::post('/category/create',[CategoryController::class, 'store'])->name('category.store');
     Route::get('/category/update/{id}',[CategoryController::class, 'edit'])->name('category.edit');
     Route::post('/category/update',[CategoryController::class, 'store'])->name('category.store');
     Route::get('/category/delete/{id}',[CategoryController::class, 'delete'])->name('category.delete');

     // SubCategory
     Route::get('/subcategory',[SubCategoryController::class, 'index'])->name('subcategory');
     Route::get('/subcategory/create',[SubCategoryController::class, 'create'])->name('subcategory.create');
     Route::post('/subcategory/create',[SubCategoryController::class, 'store'])->name('subcategory.store');
     Route::get('/subcategory/update/{id}',[SubCategoryController::class, 'edit'])->name('subcategory.edit');
     Route::post('/subcategory/update',[SubCategoryController::class, 'store'])->name('subcategory.store');
     Route::get('/subcategory/delete/{id}',[SubCategoryController::class, 'delete'])->name('subcategory.delete');

     // Country
     Route::get('/country',[CountryController::class, 'index'])->name('country');
     Route::get('/country/create',[CountryController::class, 'create'])->name('country.create');
     Route::post('/country/create',[CountryController::class, 'store'])->name('country.store');
     Route::get('/country/update/{id}',[CountryController::class, 'edit'])->name('country.edit');
     Route::post('/country/update',[CountryController::class, 'store'])->name('country.store');
     Route::get('/country/delete/{id}',[CountryController::class, 'delete'])->name('country.delete');

     // Currency
     Route::get('/currency',[CurrencyController::class, 'index'])->name('currency');
     Route::get('/currency/create',[CurrencyController::class, 'create'])->name('currency.create');
     Route::post('/currency/create',[CurrencyController::class, 'store'])->name('currency.store');
     Route::get('/currency/update/{id}',[CurrencyController::class, 'edit'])->name('currency.edit');
     Route::post('/currency/update',[CurrencyController::class, 'store'])->name('currency.store');
     Route::get('/currency/delete/{id}',[CurrencyController::class, 'delete'])->name('currency.delete');

     // Units
     Route::get('/unit',[UnitController::class, 'index'])->name('unit');
     Route::get('/unit/create',[UnitController::class, 'create'])->name('unit.create');
     Route::post('/unit/create',[UnitController::class, 'store'])->name('unit.store');
     Route::get('/unit/update/{id}',[UnitController::class, 'edit'])->name('unit.edit');
     Route::post('/unit/update',[UnitController::class, 'store'])->name('unit.store');
     Route::get('/unit/delete/{id}',[UnitController::class, 'delete'])->name('unit.delete');

     // Brands
     Route::get('brand',[BrandController::class, 'index'])->name('brand');
     Route::get('/brand/create',[BrandController::class, 'create'])->name('brand.create');
     Route::post('/brand/create',[BrandController::class, 'store'])->name('brand.store');
     Route::get('/brand/update/{id}',[BrandController::class, 'edit'])->name('brand.edit');
     Route::post('/brand/update',[BrandController::class, 'store'])->name('brand.store');
     Route::get('/brand/delete/{id}',[BrandController::class, 'delete'])->name('brand.delete');

    // Products
    Route::prefix('products')->group(function(){
        Route::get('',[ProductController::class, 'index'])->name('products');
        Route::get('/create',[ProductController::class, 'create'])->name('products.create');
        Route::post('/create',[ProductController::class, 'store'])->name('products.store');
        Route::get('/update/{id}',[ProductController::class, 'edit'])->name('products.edit');
        Route::post('/update',[ProductController::class, 'store'])->name('products.store');
        Route::get('/delete/{id}',[ProductController::class, 'delete'])->name('products.delete');
        Route::get('/deletedList',[ProductController::class, 'archive'])->name('products.archive');
        Route::get('/restore/{id}',[ProductController::class, 'restore'])->name('products.restore');
        Route::get('/permanentDelete/{id}',[ProductController::class, 'parmenentDelete'])->name('products.pdelete');
    });

    // Coupon 
    Route::prefix('coupon')->group(function(){
        Route::get('',[CouponController::class, 'index'])->name('coupon');
        Route::get('/create',[CouponController::class, 'create'])->name('coupon.create');
        Route::post('/create',[CouponController::class, 'store'])->name('coupon.store');
        // Route::get('/update/{id}',[ProductController::class, 'edit'])->name('products.edit');
        // Route::post('/update',[ProductController::class, 'store'])->name('products.store');
        // Route::get('/delete/{id}',[ProductController::class, 'delete'])->name('products.delete');
        // Route::get('/deletedList',[ProductController::class, 'archive'])->name('products.archive');
        // Route::get('/restore/{id}',[ProductController::class, 'restore'])->name('products.restore');
        // Route::get('/permanentDelete/{id}',[ProductController::class, 'parmenentDelete'])->name('products.pdelete');
    });

    // Slider 
    Route::prefix('slider')->group(function(){
        Route::get('',[SliderController::class, 'index'])->name('slider');
        Route::get('/create',[SliderController::class, 'create'])->name('slider.create');
        Route::post('/create',[SliderController::class, 'store'])->name('slider.store');
        // Route::get('/update/{id}',[ProductController::class, 'edit'])->name('products.edit');
        // Route::post('/update',[ProductController::class, 'store'])->name('products.store');
        // Route::get('/delete/{id}',[ProductController::class, 'delete'])->name('products.delete');
        // Route::get('/deletedList',[ProductController::class, 'archive'])->name('products.archive');
        // Route::get('/restore/{id}',[ProductController::class, 'restore'])->name('products.restore');
        // Route::get('/permanentDelete/{id}',[ProductController::class, 'parmenentDelete'])->name('products.pdelete');
    });

    // Activity Log
    Route::get('activity',[ActivityLogController::class,'index'])->name('actvitylog');

    });
});

// Route::get('/home', [HomeController::class, 'index']);


// Client Side Routes
require('web_client.php');

