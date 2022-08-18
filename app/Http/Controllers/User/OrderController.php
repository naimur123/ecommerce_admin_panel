<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //Store user shipping address
    public function storeAddress(Request $request){

       
        
            $shipping = new ShippingAddress();
            $shipping->user_id = $request->user;
            $shipping->area_name = $request->area_name;
            $shipping->for_later = $request->for_later;
            $shipping->save();

            if($request->payment_type == "Cash"){
                return Redirect::route('pay.cash');
            }
            else{
                return Redirect::route('easy.checkout');
            }
       
    }
    public function cashview(){

        $user = Session::get('user');
        $shipping = ShippingAddress::where('user_id',$user)->select('id','area_name')->get();
        if(session()->has('cart')){
            $cart = session()->get('cart');
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
        }
        $shipping_cost = 50;
        $total = $subtotal + $shipping_cost;
        // foreach($shipping as $address){
        //     dd($address->id);
        // }
        $params = [

            "user" => $user,
            "shipping" => $shipping,
            "subtotal" => $subtotal,
            "shipping_cost" => $shipping_cost,
            "total" => $total,
            // "form_url" => route('pay.cash.store')
        ];
        return view('frontend.user.cash',$params);
    }

    // Cash store
    public function cashstore(Request $request){

        $order = new Order();
        $order->user_id = $request->user ?? null;
        $order->shipping_id = $request->shipping_id ?? null;
        $order->total_price = $request->total_price ?? null;
        $order->sub_total_price = $request->sub_total_price ?? null;
        $order->shipping_cost = $request->shipping_cost ?? null;
        $order->discount_price = $request->discount_price ?? null;
        $order->payment_type = "Cash";
        $order->status_id = 2;
        $order->save();

        session()->flush('cart');

    }

    public function onlineview(){

        $user = Session::get('user');
        $shipping = ShippingAddress::where('user_id',$user)->select('id','area_name')->get();
        if(session()->has('cart')){
            $cart = session()->get('cart');
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
        }
        $shipping_cost = 50;
        $total = $subtotal + $shipping_cost;
        // foreach($shipping as $address){
        //     dd($address->id);
        // }
        $params = [

            "user" => $user,
            "shipping" => $shipping,
            "subtotal" => $subtotal,
            "shipping_cost" => $shipping_cost,
            "total" => $total,
            // "form_url" => route('pay.online.store')
        ];
        return view('frontend.user.online',$params);
    }
   
}
