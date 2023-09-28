<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
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
        // $category = Category::where('status_id', 1)->get();

        // dd($category);
    //    $product = DB::table('products')
    //                 ->join('currencies', 'currencies.id', '=', 'products.currency_id')
    //                 ->selectRaw('MIN(products.id) as id, products.name as product_name, MIN(products.discount_price) as discount_price, MIN(products.price) as price, currencies.currency_symbol as currency_symbol')
    //                 ->groupBy('product_name', 'currency_symbol')
    //                 ->get();
    //     dd($product);

        $params = [
            // "categories" => Category::where('status_id',1)->get(),
            "brands"     => Brand::where('status_id', 1)->get(),
            "categories" => Category::where('status_id', 1)->get(),
            // "products" => Product::where('status_id',1)->paginate(12),
            "products" => DB::table('products')
                            ->join('currencies', 'currencies.id', '=', 'products.currency_id')
                            ->selectRaw('MIN(products.id) as id, products.name as product_name, 
                                        MIN(products.discount_price) as discount_price, 
                                        MIN(products.price) as price, 
                                        currencies.currency_symbol as currency_symbol,
                                        MIN(products.image_one) as image_one')
                            ->groupBy('product_name', 'currency_symbol')
                            ->get(),
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
                "product_id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->discount_price != 0 ? $product->price - $product->discount_price : $product->price,
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
            // dd($user);
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
                    "shippings" => ShippingAddress::all()
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
        
            $product = Product::findOrFail($request->id);
            $vendor = Product::where('name', $product->name)->with('vendor')->get();
            $params =[
                'products' => Product::with('categories','subcategory','brands','status','currency')->where('id',$request->id)->get(),
                'vendors'  => $vendor
            ];
            return view('frontend.productDetails.details', $params);
        
       
    }

    // nameWise product show
    public function nameWiseShow(Request $request){
        // dd($request->name);
        if($request->name && $request->name =='category'){
            $title = Category::where('id',$request->id)->value('name');
            $product = Product::where('category_id',$request->id)->get();
        }
        else if($request->name && $request->name =='subcategory'){
            $title = SubCategory::where('id',$request->id)->value('name');
            $product = Product::where('subcategory_id',$request->id)->get();
        }
        else{
            $title = Brand::where('id',$request->id)->value('name');
            $product = Product::where('brand_id',$request->id)->get();
        }
        $params =[
            "title"    => $title,
            "products" => $product
        ];
        return view('frontend.home.nameWiseProduct', $params);
    }

    // Product search
    public function searchProduct(Request $request){
        
        $keyword = $request->text;

        // $product = Product::where('name', 'LIKE', '%' . $keyword . '%')->first();
        $product = DB::table('products')
                    ->selectRaw('MIN(products.id) as id, products.name as product_name')
                    ->where('products.name', 'LIKE', '%' . $keyword . '%')
                    ->groupBy('product_name')
                    ->get();
        return response($product);
        
        
        // 

    }

}
