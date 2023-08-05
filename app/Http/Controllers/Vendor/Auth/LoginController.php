<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        $this->redirectTo = route('vendor.home');
        $this->logout = route('vendor.login');
    }

    // Show Login Form
    public function showloginform(Request $request){
        if( Auth::guard('vendor')->check() ){
            return redirect($this->redirectTo);
        }
        return view('vendors.auth.login');
    }

    protected function guard()
    {
        return Auth::guard('vendor');
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
        Auth::guard('vendor')->logout();
        return redirect($this->logout);
    }

    // After Login Dashboard
    public function dashboard(Request $request){

        // $order = DB::table('orders')
        //                         ->join('order_details','order_details.order_id','=','orders.id')
        //                         ->join('products','products.id','=','order_details.product_id')
        //                         ->select('orders.transaction_id', DB::raw('COUNT(orders.id) as total_orders'))
        //                         ->where('products.vendor_id', '=', Auth::user()->id)
        //                         ->groupBy('orders.transaction_id')
        //                         ->get();
        // dd($order);
     
        $vendor = Auth::user()->id;
    
        if($request->user() == null){
           echo "empty";
        }
        else{
            $params =[

                "allOrders" => OrderDetails::with('productOrdered', 'order')
                                ->whereHas('productOrdered', function ($query) use ($vendor) {
                                    $query->where('vendor_id', $vendor);
                                })
                                ->count(),
                                
                "todayOrders" =>  Order::whereHas('orderDetails.productOrdered', function ($query) use ($vendor) {
                                        $query->where('vendor_id', $vendor);
                                    })
                                    ->whereDate('created_at', Carbon::today())
                                    ->count()
            ];
            return view('vendors.dashboard.home',$params);
          

        }
       
        
    }
   
}
