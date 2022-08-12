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
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //GetModel
    private function getModel(){
        return new Product();
    }

    //Get Datas
    public function index(Request $request){
        $products = Product::paginate(10);
        $params =[
            "title" => "List",
            "product" => $products
        ];

        $admin = Session::get('admin');
        $this->saveActivity($request, "Product list viewed",$admin);

        return view('admin.product.productList',$params);
    }

    //create
    public function create(Request $request){
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
        $admin = Session::get('admin');
        $this->saveActivity($request, "Create product page opened",$admin);

        return view('admin.product.create',$params);
    }
    //store product
    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2',
                'slug' => 'nullable|min:2',
                // 'code' => 'required|numeric|min:4',
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
                        $data->code = Str::random(6);
                        $data->created_by = Session::get('admin');
                    }
                    $admin = Session::get('admin');
                    $this->saveActivity($request, "New product added",$admin);
                    
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = Session::get('admin');

                    $message = "product edited";
                    $msg = implode(' ', array($data->name, $message));
                    $admin = Session::get('admin');
                    $this->saveActivity($request, $msg, $admin);
                }
    
                $data->category_id = $request->category_id;
                $data->subcategory_id  = $request->subcategory_id ;
                $data->brand_id = $request->brand_id;
                // $data->name = $request->name;
                $data->slug = $request->slug ?? null;
                $data->quantity = $request->quantity;
                $data->unit_id = $request->unit_id;
                $data->short_description = $request->short_description ?? null;
                $data->long_description = $request->long_description ?? null;
                $data->price = $request->price;
                $data->discount_price = $request->discount_price ?? 0;
                $data->discount_percentage = $request->discount_percentage ?? 0;
                $data->currency_id = $request->currency_id;
                $data->image_one = $this->uploadImage($request, 'image_one', $this->product,null,null,$data->image_one);
                if($request->has('image_two')){
                    $data->image_two =  $this->uploadImage($request, 'image_two', $this->product,null,null);
                }
                if($request->has('image_three')){
                    $data->image_three = $this->uploadImage($request, 'image_three', $this->product,null,null);

                }
               
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
                return back()->with("error", $this->getError($e))->withInput();
            }
    
            // $this->saveActivity($request, "Add New Advisor", $data); 
        return back()->with("success", $request->id == 0 ? "Product Added Successfully" : "Product Updated Successfully");
    }

    //product edit
    public function edit(Request $request, $id){

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
       //Activity message
       $message = "edit page opened";
       $msg = implode(' ', array($product->name, $message));
       $admin = Session::get('admin');
       $this->saveActivity($request, $msg, $admin);

       return view('admin.product.create',$params);
    }

    //product Delete
    public function delete(Request $request, $id){

        try{
         $data = $this->getModel()->find($id);
         if(!empty($data)){
            $data->delete();
            $message = "product archived";
            $msg = implode(' ', array($data->name, $message));
            $admin = Session::get('admin');
            $this->saveActivity($request, $msg, $admin);
         }
         return back();
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
    }

    //product archive list
    public function archive(Request $request){

        $products = $this->getModel()->onlyTrashed()->paginate(10);
        $params =[
            "title"  => "Deleted List",
            "product" => $products
        ];
        $admin = Session::get('admin');
        $this->saveActivity($request,"Product archive list viewed", $admin);
        return view('admin.product.productList',$params);
        
    }
    //product restore
    public function restore(Request $request, $id){

        try{
            $this->getModel()->onlyTrashed()->find($id)->restore();
            $admin = Session::get('admin');
            $this->saveActivity($request,"Product Restored", $admin);
            return redirect()->route('admin.products');
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
        
    }
    //product permanent delete
    public function parmenentDelete(Request $request, $id){

        try{
          $product = $this->getModel()->onlyTrashed()->find($id);
          if(!empty($product)){
            $product->forceDelete();
            $message = "product permanently deleted";
            $msg = implode(' ', array($product->name, $message));
            $admin = Session::get('admin');
            $this->saveActivity($request, $msg, $admin);
          }
          
          return redirect()->route('admin.products.archive');
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
        
    }

}
