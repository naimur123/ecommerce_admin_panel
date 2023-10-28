<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Unit;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VendorProductController extends Controller
{
      //GetModel
      private function getModel(){
        return new Product();
      }
      //create
      public function create(Request $request){
        $params = [
             "title"       => "Create",
             "form_url"    => route('vendor.products.store'),
             "categories"  => Category::all(),
             "subs"        => SubCategory::all(),
             "brands"      => Brand::all(),
             "units"       => Unit::all(),
             "currencies"  => Currency::all(),

        ];
      

        return view('vendors.product.create',$params);
    }

    //store product
    public function store(Request $request){
        // dd($image_one);
            Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2',
                'slug' => 'nullable|min:2',
                // 'code' => 'required|numeric|min:4',
                'quantity' => 'required|numeric|min:1',
                'price' => 'required',
                'short_description' => 'nullable',
                'long_description' => 'nullable'
    
            ]
           )->validate();

            try{
                DB::beginTransaction();
                if( $request->id == 0 ){
                    $data = $this->getModel();
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = $request->user()->id;

                }
                $data->vendor_id = Auth::user()->id;
                $data->code = $request->code;
                $data->category_id = $request->category_id;
                $data->subcategory_id  = $request->subcategory_id ?? null;
                $data->brand_id = $request->brand_id;
                $data->name = $request->name;
                $data->slug = $request->slug ?? null;
                $data->quantity = $request->quantity;
                $data->unit_id = $request->unit_id;
                $data->short_description = $request->short_description ?? null;
                $data->long_description = $request->long_description ? $this->htmlText($request->long_description) : $data->long_description;
                $data->price = $request->price;
                $data->discount_percentage = $request->discount_percentage ?? 0;
                $data->discount_price = $request->discount_percentage ? ($request->price*$request->discount_percentage/100) : 0;
                $data->currency_id = $request->currency_id;
                if($request->has('image_one')){
                    $image_one = $request->file('image_one');
                    $data->image_one = $this->uploadImage($image_one,$this->product);
                }
                if($request->has('image_two')){
                    $image_two = $request->file('image_two');
                    $data->image_two = $this->uploadImage($image_two,$this->product);
                }
                if($request->has('image_three')){
                    $image_three = $request->file('image_three');
                    $data->image_three = $this->uploadImage($image_three,$this->product);
                }
               
                $data->status_id = 2;
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
        return back()->with("success", $request->id == 0 ? "Product Added Successfully,Wait for Admin Approval" : "Product Updated Successfully");
    }

    // public function getSubcategory(Request $request){
    //     $subcategory = SubCategory::where('category_id',$request->category_id)->get();
    //     if (count($subcategory) > 0) {
    //         return response()->json($subcategory);
    //         // dd($subcategory);
            
    //     }
    //     else{
    //         return 0;
    //     }
    // }
}
