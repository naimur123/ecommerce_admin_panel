<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback(){
        $user = Socialite::driver('google')->user();
        dd($user);
    }

    // public function redirectToFb(){
    //     return Socialite::driver('facebook')->redirect();
    // }
    // public function facebookCallback(){
    //     $user = Socialite::driver('facebook')->user();
    //     dd($user);
    // }
}
