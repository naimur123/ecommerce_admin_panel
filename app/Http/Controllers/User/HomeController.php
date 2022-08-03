<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        $params = [
            "categories" => Category::where('status_id',1)->get(),
            "products" => Product::where('status_id',1)->get(),
            "subcategories" => SubCategory::where('status_id',1)->get(),
            "sliders"  => Slider::where('status_id',1)->get(),
            "latest_products" => Product::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get(),
        ];
        return view('frontend.masterPage',$params);
    }
}
