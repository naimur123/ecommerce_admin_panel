<?php

use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GenericStatusController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UnitController;

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
    Route::post('logout',[AdminController::class, 'logout'])->name('logout');

     // Generic Status
    //  Route::get('products',[ProductController::class, 'index'])->name('products');
     Route::get('/status/create',[GenericStatusController::class, 'create'])->name('status.create');
     Route::post('/status/create',[GenericStatusController::class, 'store'])->name('status.store');

     // Category
    //  Route::get('products',[ProductController::class, 'index'])->name('products');
     Route::get('/category/create',[CategoryController::class, 'create'])->name('category.create');
     Route::post('/category/create',[CategoryController::class, 'store'])->name('category.store');

     // SubCategory
    //  Route::get('products',[ProductController::class, 'index'])->name('products');
     Route::get('/subcategory/create',[SubCategoryController::class, 'create'])->name('subcategory.create');
     Route::post('/subcategory/create',[SubCategoryController::class, 'store'])->name('subcategory.store');

     // Country
    //  Route::get('products',[ProductController::class, 'index'])->name('products');
     Route::get('/country/create',[CountryController::class, 'create'])->name('country.create');
     Route::post('/country/create',[CountryController::class, 'store'])->name('country.store');

     // Currency
    //  Route::get('products',[ProductController::class, 'index'])->name('products');
     Route::get('/currency/create',[CurrencyController::class, 'create'])->name('currency.create');
     Route::post('/currency/create',[CurrencyController::class, 'store'])->name('currency.store');

     // Units
    //  Route::get('products',[ProductController::class, 'index'])->name('products');
     Route::get('/unit/create',[UnitController::class, 'create'])->name('unit.create');
     Route::post('/unit/create',[UnitController::class, 'store'])->name('unit.store');

     // Brands
    //  Route::get('products',[ProductController::class, 'index'])->name('products');
     Route::get('/brand/create',[BrandController::class, 'create'])->name('brand.create');
     Route::post('/brand/create',[BrandController::class, 'store'])->name('brand.store');

    // Products
    Route::get('/products',[ProductController::class, 'index'])->name('products');
    Route::get('/products/create',[ProductController::class, 'create'])->name('products.create');
    Route::post('/products/create',[ProductController::class, 'store'])->name('products.store');
    Route::get('/products/update/{id}',[ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/update',[ProductController::class, 'store'])->name('products.store');
    Route::get('/products/delete/{id}',[ProductController::class, 'delete'])->name('products.delete');

    });
});

// Route::get('/home', [HomeController::class, 'index']);
