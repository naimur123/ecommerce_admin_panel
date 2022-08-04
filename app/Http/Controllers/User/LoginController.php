<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function googleSignin(){
        $user = Socialite::driver('google')->user();
        
        $find = User::where('social_id', $user->id)->first();

        if($find){
            return redirect()->route('user.register')->with('alert','Account already exists');
        }
        else{
            $data = New User();
            $data->name = $user->name;
            $data->email = $user->email;
            $data->phone = $user->phone ?? null;
            $data->password = bcrypt(123456);
            $data->social_id = $user->id;
            $data->save();

            return redirect()->route('home');
        }
    }

    // public function redirectToFb(){
    //     return Socialite::driver('facebook')->redirect();
    // }
    // public function facebookCallback(){
    //     $user = Socialite::driver('facebook')->user();
    //     dd($user);
    // }
    public function showRegisterform(){
        return view('frontend.auth.register');
    }
}
