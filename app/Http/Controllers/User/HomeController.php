<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index(){
       

        // $category_id = SubCategory::where('status_id', 1)->pluck('category_id')->toArray();

        // $category = Category::whereNotIn('id', $category_id)->take(3)->get();
        $category = Category::where('status_id', 1)->get();

        // dd($category);

        $params = [
            // "categories" => Category::where('status_id',1)->get(),
            "categories" => $category,
            "products" => Product::where('status_id',1)->paginate(12),
            "subcategories" => SubCategory::where('status_id',1)->take(5)->get(),
            "sliders"  => Slider::where('status_id',1)->get(),
            "latest_products" => Product::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(12),
        ];
        // dd($params);
        return view('frontend.home.home',$params);
    }

    // Cart Add
    public function addTocart(Request $request, $id){
        $product = Product::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            Alert::warning('Warning', 'Product Already Added To Cart');
            return redirect()->back();
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_one
            ];
        }
          
        session()->put('cart', $cart);
        Alert::success('Success', 'Product Added To Cart');
        return redirect()->back();
    }

    // Cart details
    public function cart(Request $request){

        return view('frontend.cart.cart');
    }

    // Cart item quantity update
    public function cartUpdate(Request $request){
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    
    //Cart item delete
    public function cartDelete(Request $request, $id){
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            Alert::success('Success', 'Cart deleted successfully');
            return redirect()->back();
        }
    }

    //Checkout
    public function checkout(){
        if(Session::has('user')){
            $user = Session::get('user');
                if(session()->has('cart')){
                    $cart = session()->get('cart');
                    $subtotal = 0;
                    foreach ($cart as $item) {
                        $subtotal += $item['price'] * $item['quantity'];
                    }
                }
                $shipping_cost = 50;
                $total = $subtotal + $shipping_cost;
                $params=[
                    "user" => $user,
                    "subtotal" => $subtotal,
                    "shipping_cost" => $shipping_cost,
                    "total" => $total,
                ];
                return view('frontend.user.order', $params);
            
        }
        else{
            Session::put('checkout','checkoutclick');
            return redirect()->route('user.login');
        }
       
    }

    //product details
    public function productDetails(Request $request){
        
            $params =[
                'products' => Product::with('categories','subcategory','brands','status','currency')->where('id',$request->id)->get()
            ];
            return view('frontend.productDetails.details', $params);
        
       
    }

}
