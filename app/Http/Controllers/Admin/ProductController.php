<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //GetModel
    private function getModel(){
        return new Product();
    }

    //Get Datas
    public function index(){
        $products = Product::all();
        $params =[
            
            "product" => $products
        ];

        // print_r($products);

        return view('admin.product.productList',$params);
    }

}
