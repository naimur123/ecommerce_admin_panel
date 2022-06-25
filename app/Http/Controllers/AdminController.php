<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function __construct()
    {
        $this->redirectTo = route("admin.home");
        $this->logout = route("admin.login");
    }

    // Show Login Form
    public function showloginform(){
        if( Auth::guard('admin')->check() ){
            return redirect($this->redirectTo);
        }
        return view('auth.login');
    }

    // Login
    public function login(Request $request){
        try{
          Validator::make($request->all(), [
                "email"     => ["required", "email", "exists:admins,email"],
                "password"  => ["required", "string", "min:4", "max:40"]
            ])->validate(); 

            $admin = Admin::where("email", $request->email)->first();
            if( !empty($admin) ){
                if( Hash::check($request->password, $admin->password) ){
                    Session::put('email',$admin->email);
                    return redirect()->route('admin.home');
                    
                }else{
                    return back()->with('error',"Account doesnot match");
                }
            }else{
                return back()->withErrors('error',"Not a admin");
            }

        }catch(Exception $e){
            return back()->with("error","Input fiels");
        }
    }

    // After Login Dashboard
    public function dashboard(){
        return view('admin.dashboard.home');
    }

    //Logout
    protected function logout(){
        Session::forget('email');
        return redirect($this->logout);
        
    }

    //Admin route Guard
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
