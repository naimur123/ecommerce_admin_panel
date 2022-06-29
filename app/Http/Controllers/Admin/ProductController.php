<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Currency;
use App\Models\GenericStatus;
use App\Models\SubCategory;
use App\Models\Country;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

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

    //create
    public function create(){
        $params = [
             "title"       => "Create",
             "form_url"    => route('admin.products.store'),
             "categories" => Category::all(),
             "subs"       => SubCategory::all(),
             "brands"     => Brand::all(),
             "units"      => Unit::all(),
             "currencies" => Currency::all(),
             "statuses"     => GenericStatus::all()

        ];
        return view('admin.product.create',$params);
    }
    //store product
    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2',
                'slug' => 'nullable|min:2',
                'code' => 'required|numeric|min:4',
                'quantity' => 'required|numeric|min:1',
                'price' => 'required',
                'short_description' => 'nullable|min:2|max:50',
                'long_description' => 'nullable|min:2|max:250'
    
            ]
           )->validate();

            try{
                DB::beginTransaction();
                if( $request->id == 0 ){
                    $data = $this->getModel();
                    if(Session::has('admin')){
                        $data->created_by = Session::get('admin');
                    }
                    
                }
                // else{
                //     $data = $this->getModel()->find($request->id);
                //     $data->modifiedby = 1;
                //     $data->modifieddate = Carbon::Now();
                // }
    
                $data->category_id = $request->category_id;
                $data->subcategory_id  = $request->subcategory_id ;
                $data->brand_id = $request->brand_id;
                $data->name = $request->name;
                $data->slug = $request->slug ?? null;
                $data->code = $request->code;
                $data->quantity = $request->quantity;
                $data->unit_id = $request->unit_id;
                $data->short_description = $request->short_description ?? null;
                $data->long_description = $request->long_description ?? null;
                $data->price = $request->price;
                $data->discount_price = $request->discount_price ?? 0;
                $data->discount_percentage = $request->discount_percentage ?? 0;
                $data->currency_id = $request->currency_id;
                $data->image_one = $this->uploadImage($request, 'image_one', $this->product,null,null);
                $data->image_two =  $this->uploadImage($request, 'image_two', $this->product,null,null) ?? null;
                $data->image_three = $this->uploadImage($request, 'image_three', $this->product,null,null) ?? null;
                $data->status_id = $request->status_id;
                $data->save();
                
                DB::commit();
                try{
                    if($request->id == 0){
                        event(new Registered($data));
                    }
                }catch(Exception $e){
                    //
                }
            }catch(Exception $e){
                DB::rollBack();
                // return back()->with("error", $this->getError($e))->withInput();
            }
    
            // $this->saveActivity($request, "Add New Advisor", $data); 
        return back();
    }

    //product edit
    public function edit($id){

        $product = Product::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.products.store'),
            "categories" => Category::all(),
            "subs"       => SubCategory::all(),
            "brands"     => Brand::all(),
            "units"      => Unit::all(),
            "currencies" => Currency::all(),
            "statuses"   => GenericStatus::all(),
            "data"       => $product

       ];
       return view('admin.product.create',$params);
    }

    //product Delete
    public function delete($id){

        try{
        $data = $this->getModel()->find($id);
        $data->delete();
        //  Products::where('id',$id)->delete();
         return back();
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
    }

}
