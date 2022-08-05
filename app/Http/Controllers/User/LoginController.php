<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
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
            $data->email_verified_at = Carbon::now();
            $data->phone = $user->phone ?? null;
            $data->password = bcrypt(123456);
            $data->social_id = $user->id;
            $data->save();

            return view('frontend.user.dashboard')->with('user', $data);
            // return redirect()->route('user.dashboard')->with(['id'=>$user->id,'succes' => 'Alread Apply for this post']);
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
