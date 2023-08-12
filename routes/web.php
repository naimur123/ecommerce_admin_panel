<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\Auth\LoginController as AuthLoginController;
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
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\WebsiteSettingsController;
use App\Http\Controllers\User\LoginController;
use Illuminate\Support\Facades\Artisan;

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
Route::get('/admin/login',[AuthLoginController::class, 'showloginform']);
Route::post('/admin/login',[AuthLoginController::class, 'login'])->name('admin.login');



Route::middleware(["auth:admin"])->group(function(){

        Route::prefix('admin')->name('admin.')->group(function(){

        Route::get('home',[AuthLoginController::class, 'dashboard'])->name('home');
        Route::get('logout',[AuthLoginController::class, 'logout'])->name('logout');

        Route::get('website/setting',[WebsiteSettingsController::class, 'create'])->name('website.create');
        Route::post('website/setting',[WebsiteSettingsController::class, 'store'])->name('website.store');

        // Route::prefix('admin')->group(function(){
        //    Admin
            Route::get('',[AdminAdminController::class,'index'])->name('admin');
            Route::get('/create',[AdminAdminController::class,'create'])->name('admin.create');
            Route::get('/edit/{id}',[AdminAdminController::class,'edit'])->name('admin.edit');
            Route::post('/edit',[AdminAdminController::class,'store'])->name('admin.store');
            Route::post('/create',[AdminAdminController::class,'store'])->name('admin.store');
            Route::get('/create/permission',[AdminAdminController::class,'createPermission'])->name('create.permisssion');
            Route::post('/create/permission',[AdminAdminController::class,'addPermission'])->name('permisssion.add');
            Route::get('/give/permission/{id}',[AdminAdminController::class,'permission'])->name('permisssion');
            Route::post('/give/permission',[AdminAdminController::class,'permissionStore'])->name('permisssion.store');
            Route::get('/vendor/pendinglist',[VendorController::class,'pendingVendor'])->name('pending.vendor');
            Route::get('/vendor/statusupdate',[VendorController::class,'statusupdate'])->name('statusupdate.vendor');
        // });

        // Generic Status
        Route::prefix('status')->group(function(){

            Route::get('',[GenericStatusController::class, 'index'])->name('status');
            Route::get('/create',[GenericStatusController::class, 'create'])->name('status.create');
            Route::post('/create',[GenericStatusController::class, 'store'])->name('status.store');
            Route::get('/update/{id}',[GenericStatusController::class, 'edit'])->name('status.edit');
            Route::post('/update',[GenericStatusController::class, 'store'])->name('status.store');
            Route::get('/delete/{id}',[GenericStatusController::class, 'delete'])->name('status.delete');

        });


        // Category
        Route::prefix('category')->group(function(){

            Route::get('',[CategoryController::class, 'index'])->name('category');
            Route::get('/create',[CategoryController::class, 'create'])->name('category.create');
            Route::post('/create',[CategoryController::class, 'store'])->name('category.store');
            Route::get('/update/{id}',[CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/update',[CategoryController::class, 'store'])->name('category.store');
            Route::get('/delete/{id}',[CategoryController::class, 'delete'])->name('category.delete');
            Route::get('/getSubcategory', [CategoryController::class, 'getSubcategory'])->name('category.subcategory');

        });

        // SubCategory
        Route::prefix('subcategory')->group(function(){

            Route::get('',[SubCategoryController::class, 'index'])->name('subcategory');
            Route::get('/create',[SubCategoryController::class, 'create'])->name('subcategory.create');
            Route::post('/create',[SubCategoryController::class, 'store'])->name('subcategory.store');
            Route::get('/update/{id}',[SubCategoryController::class, 'edit'])->name('subcategory.edit');
            Route::post('/update',[SubCategoryController::class, 'store'])->name('subcategory.store');
            Route::get('/delete/{id}',[SubCategoryController::class, 'delete'])->name('subcategory.delete');
        

        });

        // Country
        Route::prefix('country')->group(function(){

            Route::get('',[CountryController::class, 'index'])->name('country');
            Route::get('/create',[CountryController::class, 'create'])->name('country.create');
            Route::post('/create',[CountryController::class, 'store'])->name('country.store');
            Route::get('/update/{id}',[CountryController::class, 'edit'])->name('country.edit');
            Route::post('/update',[CountryController::class, 'store'])->name('country.store');
            Route::get('/delete/{id}',[CountryController::class, 'delete'])->name('country.delete');

        });

        // Currency
        Route::prefix('currency')->group(function(){

            Route::get('',[CurrencyController::class, 'index'])->name('currency');
            Route::get('/create',[CurrencyController::class, 'create'])->name('currency.create');
            Route::post('/create',[CurrencyController::class, 'store'])->name('currency.store');
            Route::get('/update/{id}',[CurrencyController::class, 'edit'])->name('currency.edit');
            Route::post('/update',[CurrencyController::class, 'store'])->name('currency.store');
            Route::get('/delete/{id}',[CurrencyController::class, 'delete'])->name('currency.delete');

        });

        // Units
        Route::prefix('unit')->group(function(){

            Route::get('',[UnitController::class, 'index'])->name('unit');
            Route::get('/create',[UnitController::class, 'create'])->name('unit.create');
            Route::post('/create',[UnitController::class, 'store'])->name('unit.store');
            Route::get('/update/{id}',[UnitController::class, 'edit'])->name('unit.edit');
            Route::post('/update',[UnitController::class, 'store'])->name('unit.store');
            Route::get('/delete/{id}',[UnitController::class, 'delete'])->name('unit.delete');

        });

        // Brands
        Route::prefix('brand')->group(function(){

            Route::get('',[BrandController::class, 'index'])->name('brand');
            Route::get('/create',[BrandController::class, 'create'])->name('brand.create');
            Route::post('/create',[BrandController::class, 'store'])->name('brand.store');
            Route::get('/update/{id}',[BrandController::class, 'edit'])->name('brand.edit');
            Route::post('/update',[BrandController::class, 'store'])->name('brand.store');
            Route::get('/delete/{id}',[BrandController::class, 'delete'])->name('brand.delete');

        });

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
            Route::get('/search',[ProductController::class, 'search'])->name('products.search');

        });

        // Coupon 
        Route::prefix('coupon')->group(function(){

            Route::get('',[CouponController::class, 'index'])->name('coupon');
            Route::get('/create',[CouponController::class, 'create'])->name('coupon.create');
            Route::post('/create',[CouponController::class, 'store'])->name('coupon.store');
           
        });

        // Slider 
        Route::prefix('slider')->group(function(){

            Route::get('',[SliderController::class, 'index'])->name('slider');
            Route::get('/create',[SliderController::class, 'create'])->name('slider.create');
            Route::post('/create',[SliderController::class, 'store'])->name('slider.store');
            Route::get('/update/{id}',[SliderController::class, 'edit'])->name('slider.edit');
            Route::post('/update',[SliderController::class, 'store'])->name('slider.store');
            Route::get('/delete/{id}',[SliderController::class, 'delete'])->name('slider.delete');
          
        });

        // Email 
        Route::prefix('email')->group(function(){
            Route::get('/create',[EmailController::class, 'create'])->name('emailtemplate.create');
            Route::post('/create',[EmailController::class, 'store'])->name('emailtemplate.store');

        });

        // Activity Log
        Route::get('activity',[ActivityLogController::class,'index'])->name('actvitylog');

        // Vendor
        Route::prefix('vendor')->group(function(){

            Route::get('',[VendorController::class,'index'])->name('vendor');
            Route::get('/create',[VendorController::class,'create'])->name('vendor.create');
            Route::post('/update',[VendorController::class,'store'])->name('vendor.store');
            Route::get('/permission/{id}',[VendorController::class,'permission'])->name('vendor.permisssion');
            Route::post('/permission',[VendorController::class,'permissionStore'])->name('vendor.permisssion.store');

        });
        // Customer
        Route::prefix('customer')->group(function(){

            Route::get('',[CustomerController::class,'index'])->name('customer');
            Route::get('/update/{id}',[CustomerController::class,'edit'])->name('customer.edit');
            Route::post('/update',[CustomerController::class,'store'])->name('customer.store');
            Route::get('/delete/{id}',[CustomerController::class,'delete'])->name('customer.delete');
            Route::get('/deletedList',[CustomerController::class, 'archive'])->name('customer.archive');
            Route::get('/restore/{id}',[CustomerController::class, 'restore'])->name('customer.restore');
            Route::get('/permanentDelete/{id}',[CustomerController::class, 'parmenentDelete'])->name('customer.pdelete');
            Route::get('/customerlistpdf',[CustomerController::class,'pdf'])->name('customer.pdf');
            Route::get('/customerlistexcel',[CustomerController::class,'excel'])->name('customer.excel');

        });

        //Orders
        Route::prefix('orders')->group(function(){
            Route::get('',[OrderController::class,'index'])->name('order.list');
        });

        Route::get('test',[EmailController::class,'test']);

        });
});
// });


// Route::get('/home', [HomeController::class, 'index']);
Route::get('test',[EmailController::class,'test']);

Route::get('checkPage',function(){
    return view('admin.checkMenu');
});


// Client Side Routes
// require('web_client.php');
// require('web_vendor.php');

