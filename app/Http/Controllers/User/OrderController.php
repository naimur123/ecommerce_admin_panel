<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\PaymentType;
use App\Models\ShippingAddress;
use App\Models\Transactions;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //Order place view
    // public function orderplaceview(){

    //     $user = Session::get('user');
    //     $shipping = ShippingAddress::where('user_id',$user)->select('id','area_name')->get();
    //     if(session()->has('cart')){
    //         $cart = session()->get('cart');
    //         $subtotal = 0;
    //         foreach ($cart as $item) {
    //             $subtotal += $item['price'] * $item['quantity'];
    //         }
    //     }
    //     $shipping_cost = 50;
    //     $total = $subtotal + $shipping_cost;
    //     // foreach($shipping as $address){
    //     //     dd($address->id);
    //     // }
    //     $params = [

    //         "user" => $user,
    //         "shipping" => $shipping,
    //         "subtotal" => $subtotal,
    //         "shipping_cost" => $shipping_cost,
    //         "total" => $total,
    //         // "form_url" => route('pay.cash.store')
    //     ];
    //     return view('frontend.user.cash',$params);
    // }

    // Cash store
    public function cashstore(Request $request){

     try{

        
            $carts = session()->get('cart');
        
            if($request->has('phone')){
                $user = User::find($request->user);
                $user->phone = $request->phone;
                $user->save();      
            }

            //payment type table
            $payment_type = new PaymentType();
            $payment_type->user_id = $request->user;
            $payment_type->name = "cash";
            $payment_type->save();

            //Shipping address
            if($request->has('area_name')){
                $shipping = new ShippingAddress();
                $shipping->user_id = $request->user;
                $shipping->area_name = $request->area_name;
                $shipping->for_later = $request->for_later;
                $shipping->save();
            }

            //Order place
            $order = new Order();
            $order->user_id = $request->user ?? null;
            $order->shipping_id = $shipping->id ?? null;
            $order->payment_type_id =  $payment_type->id ?? null;
            $order->total_price = $request->total_price ?? null;
            $order->sub_total_price = $request->sub_total_price ?? null;
            $order->shipping_cost = $request->shipping_cost ?? null;
            $order->discount_price = $request->discount_price ?? null;
            $order->status_id = 2;
            $order->save();

            //Order detials
            foreach($carts as $cartid => $cart){
                $order_details = new OrderDetails();
                $order_details->order_id = $order->id ?? null;
                $order_details->product_id = $cartid ?? null;
                $order_details->product_sales_quantity = $cart['quantity'];
                $order_details->save();
            }

       
           
        
        }catch(Exception $e){
            DB::rollBack();
            return back()->with("error", $this->getError($e))->withInput();
        }

        session()->forget('cart');
        return Redirect::route('user.dashboard', $request->user)->with("success", "Your order has been placed");

    }

    // public function onlineview(){

    //     $user = Session::get('user');
    //     $shipping = ShippingAddress::where('user_id',$user)->select('id','area_name')->get();
    //     if(session()->has('cart')){
    //         $cart = session()->get('cart');
    //         $subtotal = 0;
    //         foreach ($cart as $item) {
    //             $subtotal += $item['price'] * $item['quantity'];
    //         }
    //     }
    //     $shipping_cost = 50;
    //     $total = $subtotal + $shipping_cost;
    //     // foreach($shipping as $address){
    //     //     dd($address->id);
    //     // }
    //     $params = [

    //         "user" => $user,
    //         "shipping" => $shipping,
    //         "subtotal" => $subtotal,
    //         "shipping_cost" => $shipping_cost,
    //         "total" => $total,
    //         // "form_url" => route('pay.online.store')
    //     ];
    //     return view('frontend.user.online',$params);
    // }
   
}
