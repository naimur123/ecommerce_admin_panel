<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\User\SslCommerzPaymentController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\OrderController;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

Route::get('/',[HomeController::class,'index'])->name('home');

// User Login With google
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


//product details
Route::get('/product/details/{id}',[HomeController::class,'productDetails'])->name('product.details');

//Order Controller
// Route::get('/pay/cash',[OrderController::class,'orderplaceview'])->name('pay.cash');
Route::post('/pay/cash',[OrderController::class,'cashstore'])->name('pay.cash.store');

//category or subcategory or barnd wise product show
Route::get('/{name}/list/{id}',[HomeController::class,'nameWiseShow'])->name('nameWise.product.show');

//search product
Route::get('/search/product',[HomeController::class,'searchProduct'])->name('search.product');



//ssl commerz
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
Route::post('/success', [SslCommerzPaymentController::class, 'successes']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);


//
// Route::get('/analyticsdata',function(){
//     try {
//         $startDate = Carbon::now()->subDays(7);
//         $endDate = Carbon::now();
//         $period = Period::create($startDate, $endDate);
//         $data = Analytics::fetchVisitorsAndPageViewsByDate($period);
//         return view('test',['data' => $data]);
//     } catch (\Exception $e) {
//         // Log or display the error
//         dd($e->getMessage());
//     }
// });
Route::get('/analyticsdata', function () {
    try {
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        $period = Period::create($startDate, $endDate);
        $data = Analytics::fetchVisitorsAndPageViewsByDate($period);
        
        // // Prepare data for Chart.js
        // $labels = [];
        // $pageViews = [];

        // foreach ($data as $analyticsData) {
        //     // Assuming $analyticsData is an associative array with a 'date' and 'page_views' key
        //     $labels[] = $analyticsData['date'];
        //     $pageViews[] = $analyticsData['page_views'];
        // }

        
        return view('test', ['labels' => $period, 'pageViews' => $data]);
    } catch (\Exception $e) {
        // Log or display the error
        dd($e->getMessage());
    }
});
