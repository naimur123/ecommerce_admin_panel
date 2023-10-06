<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerifiy;
use App\Models\EmailTemplate;
use App\Models\User;
use App\Notifications\EmailVerifys;
use App\Notifications\EmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Exists;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

// use Mail;
class LoginController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function googleSignin(){

        $user = Socialite::driver('google')->stateless()->user();
        
        $find = User::where('email', $user->email)->first();

            if($find){
                // Alert::warning('Warning','Account Already Exist');
                // return redirect()->route('user.register');
                if(session()->has('checkout')){
                    $user = User::where('social_id',$user->id)->first();
                    Session::put('user',$user->id);
                    return Redirect()->route('cart.checkout');
                }
                else{
                    $user = User::where('social_id',$user->id)->first();
                    Session::put('user',$user->id);
                    return view('frontend.user.dashboard.dashboard');
                }
            }
            else{
                $data = New User();
                $data->name = $user->name;
                $data->email = $user->email;
                $data->email_verified_at = Carbon::now();
                $data->phone = $user->phone ?? null;
                $data->password = bcrypt(123456);
                $data->social_id = $user->id;
                $data->last_login = Carbon::now();
                $data->save();

                $params = [
                    "id" => $data->social_id,
                    "email_verified_at" => $data->email_verified_at
                ];
                if(session()->has('checkout')){
                    $user = User::where('social_id',$user->id)->first();
                    Session::put('user',$user->id);
                    return Redirect()->route('cart.checkout');
                }
                else{
                    $user = User::where('social_id',$user->id)->first();
                    Session::put('user',$user->id);
                    return view('frontend.user.dashboard.dashboard');
                }
                
            
            }
      
    }

    // public function redirectToFb(){
    //     return Socialite::driver('facebook')->redirect();
    // }
    // public function facebookCallback(){
    //     $user = Socialite::driver('facebook')->user();
    //     dd($user);
    // }
    
    //User Dashboard
    public function dashboard($id){
       
        $user = User::find($id);
        $params = [
            "id" => $user->id,
            "email_verified_at" => $user->email_verified_at
        ];
        // dd($params);
        return view('frontend.user.dashboard.dashboard',$params);
    }

    //User Register form show
    public function showRegisterform(){
        return view('frontend.auth.register');
    }

    //User Login form show
    public function index()
    {
        if(Session::has('user')){
            $user = Session::get('user');
            return Redirect::route('user.dashboard', $user);
       }
       else{
        return view('frontend.auth.login');
       }
       
    }  

    //Login credential
    public function login(Request $request){

        try{
            Validator::make($request->all(), [
                  "email"     => ["required", "email", "exists:users,email"],
                  "password"  => ["required", "string", "min:4", "max:40"]
              ])->validate(); 
  
                $user = User::where("email", $request->email)->first(); 
                if( !empty($user) ){
                    if( Hash::check($request->password, $user->password) ){
                        Session::put('user',$user->id);
                        $user->last_login = Carbon::now();
                        $user->save();
                        if(session()->has('checkout')){
                            return Redirect()->route('cart.checkout');
                        }
                        else{
                            return Redirect::route('user.dashboard', $user->id);
                        }
                    }else{
                        return back()->with('error',"Account doesnot match");
                    }
                }else{
                    
                        return back()->with('error',"Not a user");
                    
                }
            
  
          }catch(Exception $e){
               
                return back()->with('error',"Not a user");
          }
    }

    //user registration
    public function register(Request $request){
        try{
            Validator::make($request->all(), [
                "name"=>["required","string", "min:4", "max:40"],
                "email"     => ["required", "email", "unique:users,email"],
                "password"  => ["required", "string", "min:4", "max:40"]
            ])->validate(); 


            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->email_verified_at = null;
            $user->last_login = Carbon::now();
            $user->password = bcrypt($request->password);
            $user->save();

            if(session()->has('checkout')){
                $user = User::where('email',$request->email)->first();
                Session::put('user',$user->id);
                return Redirect()->route('cart.checkout');
            }
            else{
                return Redirect::route('user.dashboard', $user->id);
            }

            // return redirect()->route('user.login')->with('success',"Account created successfully.Please login");

        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
    }

    public function verifyNotification(Request $request, $id){
        
            $user = User::find($id);
            $user->notify(new EmailVerifys($user));
            return back()->with("verified","Verification email sent successfully. Please check your email.");
          
       
    }

    public function verify(Request $request, $id){
        $user = User::find($request->id);
        if(!empty($user)){
            $user->email_verified_at = Carbon::now();
            $user->save();

            return Redirect::route('user.dashboard', $user->id);
        }
    }

    public function logout(){
        
        Session::flush('user');
        session()->flush('cart');
        return redirect()->route('user.login');
    }


}
