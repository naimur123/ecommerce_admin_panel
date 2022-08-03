<?php

use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index']);