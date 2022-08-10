<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
       

        $subcategory = SubCategory::where('status_id', 1)->pluck('category_id')->toArray();

        $category = Category::whereNotIn('id', $subcategory)->take(3)->get();

        // dd($category);

        $params = [
            // "categories" => Category::where('status_id',1)->get(),
            "categories" => $category,
            "products" => Product::where('status_id',1)->paginate(20),
            "subcategories" => SubCategory::where('status_id',1)->take(2)->get(),
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
            return redirect()->back()->with('alert', 'Product already added to the cart');
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_one
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart');
    }

    // Cart details
    public function cart(Request $request){

        return view('frontend.cart.cart');
    }

    public function cartDelete(Request $request, $id){
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
            return redirect()->back();
        }
    }

}
