<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $redirectTo;
    protected $logout;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct()
    {
        $this->redirectTo = route("admin.home");
        $this->logout = route("admin.login");
    }

    // Show Login Form
    public function showloginform(Request $request){
        if( Auth::guard('admin')->check() ){
            return redirect($this->redirectTo);
        }
        return view('auth.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username()   => 'required|string',
            'password'          => 'required|string|min:3',
        ]);
    }

    /**
     * After Logout the redirect location
     */
    protected function loggedOut(){
        return redirect($this->logout) ?: redirect()->back();
    }

    // After Login Dashboard
    public function dashboard(Request $request){
        // $roles = $request->user()->getPermissionsViaRoles()->toArray();
        // dd($roles);
        // $name = $request->user()->name;
        if($request->user() == null){
           echo "empty";
        }
        else{
            $params =[

                "user" => User::all()->count(),
            ];
            return view('admin.dashboard.home',$params);

        }
       
        
    }
   
}
