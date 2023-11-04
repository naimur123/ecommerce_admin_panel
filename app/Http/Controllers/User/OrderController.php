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
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

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

            $formData = $request->all();

            $user_id = $formData['user'];
            $phone = $formData['phone'];
            $shipping_id = $formData['shipping_id'];
            $address = $formData['address_details'];
            $subtotal = $formData['subtotal'];
            $shippingCost = $formData['shipping_cost'];
            $totalAmount = $formData['total_amount'];
        
            $carts = session()->get('cart');

             //Order place
            $order = new Order();
            $order->user_id = $user_id;
            $order->phone = $phone;
            $order->shipping_id = $shipping_id;
            $order->shipping_address_details = $address;
            $order->payment_type_id = 2;
            $order->invoice_no = Str::random(8);
            $order->sub_total_price = $subtotal ?? 0;
            $order->shipping_cost = $shippingCost ?? 0;
            $order->amount = $totalAmount ?? 0;
            $order->discount_price = $discount_price ?? 0;
            $order->transaction_id = uniqid();
            $order->currency = 'BDT';
            $order->status = 'Processing';
            $order->save();

            //Order detials
            $order_id = Order::where('user_id',$user_id)->max('id');
            // return response()->json(['message' => $order_id]);

            

            foreach($carts as $cartid => $cart){
                $order_details = new OrderDetails();
                $order_details->order_id = $order_id ?? '';
                $order_details->product_id = $cart['product_id'] ?? '';
                $order_details->product_sales_quantity = $cart['quantity'];
                $order_details->save();
                DB::commit();
            }
         
         session()->forget('cart');
         $params = [
            "url" => route('home')
         ];
         return response($params);
        }
        catch(Exception $e){
            DB::rollBack();
            return back()->with("error", $this->getError($e))->withInput();
        }

        
        // return back();
        // Alert::suceess('Success','Order is been placed');
        // return Redirect()->route('home');
        // return Redirect::route('user.dashboard', $request->user)->with("success", "Your order has been placed");

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
