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
// use Mail;
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

            // return view('frontend.user.dashboard.dashboard')->with('user', $data);
            // return redirect()->route('user.dashboard');
        }
    }

    // public function redirectToFb(){
    //     return Socialite::driver('facebook')->redirect();
    // }
    // public function facebookCallback(){
    //     $user = Socialite::driver('facebook')->user();
    //     dd($user);
    // }
    public function dashboard($id){
       
        $user = User::find($id);
        $params = [
            "id" => $user->id,
            "email_verified_at" => $user->email_verified_at
        ];
        // dd($params);
        return view('frontend.user.dashboard.dashboard',$params);
    }

    public function showRegisterform(){
        return view('frontend.auth.register');
    }

    public function index()
    {
        return view('frontend.auth.login');
    }  

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
                      return Redirect::route('user.dashboard', $user->id);
                    //   return view('frontend.user.dashboard')->with('user', $user);
                      
                  }else{
                      return back()->with('error',"Account doesnot match");
                  }
              }else{
                  return back()->withErrors('error',"Not a admin");
              }
  
          }catch(Exception $e){
              return back()->with("error","Input fields");
          }
    }

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
            $user->password = bcrypt($request->password);
            $user->save();

            return view('frontend.user.dashboard')->with('user', $user);

        }catch(Exception $e){
            return back()->with("error","Input fields");
        }
        
    }

    public function verifyNotification(Request $request, $id){
        try{
            $user = User::find($id);
            
            // $id = $user->id;
            // Mail::to($user->email)->send(new EmailVerifiy($user));

            // $details = array();

            // $details['greeting'] = "Hello";
            // $details['body'] = "Please verify your email";
            // // $details['actionurl'] = "Check";
            // $details['endtext'] = "Thanks";
            // $template = EmailTemplate::where("type","smptp")->get();
            // if($template){
                $user->notify(new EmailVerifys($user));
            // }
            return back()->with('message','Verification email sent successfully. Please check your email.');
          
        }catch(Exception $e){
            
        }
    }

    public function verify(Request $request, $id){
        $user = User::find($request->id);
        if(!empty($user)){
            $user->email_verified_at = Carbon::now();
            $user->save();

            // return view('frontend.user.dashboard.dashboard')->with('user', $user);
            return Redirect::route('user.dashboard', $user->id);
        }
    }


}
