<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Currency;
use App\Models\GenericStatus;
use App\Models\SubCategory;
use App\Models\Country;
use App\Models\Unit;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;


class ProductController extends Controller
{
     // Get Table Column List
    private function getColumns(){
        $columns = ["index","vendor_name","name","category_name","subcategory_name","brand_name", "code","quantity","price","discount_price","discount_percentage","status","image","action"];
        return $columns;
    }

    // Get DataTable Column List
    private function getDataTableColumns(){
        $columns = ["index","vendor_name","name","category_name","subcategory_name","brand_name", "code","quantity","price","discount_price","discount_percentage","status_id","image_one","action"];
        return $columns;
    }

    //GetModel
    private function getModel(){
        return new Product();
    }

    //Get Datas
    public function index(Request $request){
        
        // dd($permission);
        if( $request->ajax() )
        {
            // $permission = $admin->hasPermissionTo('Product edit');
            return $this->getDataTable($request);
        }
        $params = [
            'nav'               => 'product',
            'subNav'            => 'product.list',
            "pageTitle"         => "Product List",
            'tableColumns'      => $this->getColumns(),
            'dataTableColumns'  => $this->getDataTableColumns(),
            "dataTableUrl"      => URL::current(),
            'tableStyleClass'   => 'bg-success',
           
        ];
        return view('admin.product.table', $params);

        // if( !empty($request->search) ){
        //     $search = $request->search;
        //     $products = Product::where('name','LIKE','%'.$search."%")
        //                     ->orWhere('slug','LIKE','%'.$search."%")
        //                     ->orWhere('price','LIKE','%'.$search."%")
        //                     ->orWhere('code','LIKE','%'.$search."%")
        //                     ->orWhere('quantity','LIKE','%'.$search."%")
        //                     // ->leftjoin('categories', 'product.category_id', '=', 'categories_id') 
        //                     // ->select('categories.name')
        //                     // ->distinct()
        //                     // ->where('name', 'like', '%' .$search. '%')
        //                     ->get();  
                            
        //     $params =[
        //         "title" => "Search List",
        //         "product" => $products
                
        //     ];
        //     return view('admin.product.productList',$params);
        // }
        // else{
        //     $product = Product::orderBy("id", "ASC");
        //     $products = $product->paginate(5);
        //     $params =[
        //         "title" => "List",
        //         "product" => $products,
        //         "nav"     => "product"
        //     ];
        //     return view('admin.product.productList',$params);
        // }
       

       //$admin = Session::get('admin');
        $this->saveActivity($request, "Product list viewed");

        
    }

    //create
    public function create(Request $request){
        $params = [
             "title"       => "Create",
             "form_url"    => route('admin.products.store'),
             "vendors"     => Vendor::where('is_approved',1)->get(),
             "categories"  => Category::all(),
             "subs"        => SubCategory::all(),
             "brands"      => Brand::all(),
             "units"       => Unit::all(),
             "currencies"  => Currency::all(),
             "statuses"    => GenericStatus::all()

        ];
       //$admin = Session::get('admin');
        $this->saveActivity($request, "Create product page opened");

        return view('admin.product.create',$params);
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
                    // if(Session::has('admin')){     
                        $data->created_by = $request->user()->id;
                    // }
                   //$admin = Session::get('admin');
                    $this->saveActivity($request, "New product added");
                    
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = $request->user()->id;

                    $message = "product edited";
                    $msg = implode(' ', array($data->name, $message));
                   //$admin = Session::get('admin');
                    $this->saveActivity($request, $msg);
                }
                $data->vendor_id = $request->vendor_id;
                $data->code = $request->code;
                $data->category_id = $request->category_id;
                $data->subcategory_id  = $request->subcategory_id ?? null;
                $data->brand_id = $request->brand_id;
                $data->name = $request->name;
                $data->slug = $request->slug ?? null;
                $data->quantity = $request->quantity;
                $data->unit_id = $request->unit_id;
                $data->short_description = $request->short_description ?? null;
                // $data->long_description = $request->long_description ?? null;
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

        $getcategory_id = Category::where('id',$product->category_id)->pluck('id')->toArray();

        $subcategory = SubCategory::where('category_id',$getcategory_id)->get();
        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.products.store'),
            "categories" => Category::all(),
            "subs"       => $subcategory,
            "brands"     => Brand::all(),
            "units"      => Unit::all(),
            "currencies" => Currency::all(),
            "statuses"   => GenericStatus::all(),
            "data"       => $product

       ];
       //Activity message
       $message = "edit page opened";
       $msg = implode(' ', array($product->name, $message));
      //$admin = Session::get('admin');
       $this->saveActivity($request, $msg);

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
                $this->saveActivity($request, $msg);
         }
         Alert::success('Success', 'Product Deleted');
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
       //$admin = Session::get('admin');
        $this->saveActivity($request,"Product archive list viewed");
        return view('admin.product.productList',$params);
        
    }
    //product restore
    public function restore(Request $request, $id){

        try{
            $this->getModel()->onlyTrashed()->find($id)->restore();
            $this->saveActivity($request,"Product Restored");
            Alert::success('Success', 'Product Restored');
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
            $this->saveActivity($request, $msg);
          }
          Alert::success('Success', 'Product Deleted Permanently');
          return redirect()->route('admin.products.archive');
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
        
    }

    // status update
    public function approve(Request $request){
        $status = $request->status_id;
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        if($product){
            if($status == 1){
                try{
                    $product->status_id = $status;
                    $product->save();
                    return back();

                }catch(Exception $e){

                }
            }
        }
    }

   protected function getDataTable(Request $request){
      if ($request->ajax()){
         $data = Product::with('categories','subcategory','brands','status','vendor')->get();
         
         return DataTables::of($data)->addIndexColumn()
                ->addColumn('index', function(){ return ++$this->index; })
                ->addColumn('vendor_name', function($row){ return $row->vendor->name; })
                ->addColumn('category_name', function($row){ return $row->categories->name; })
                ->addColumn('subcategory_name', function($row){ return $row->subcategory->name ?? "N/A"; })
                ->addColumn('brand_name', function($row){ return $row->brands->name ?? "N/A"; })
                ->addColumn('status_id', function($row){ return $row->status->name ?? "N/A"; })
                ->addColumn('image_one', function ($row) {
                    $imagePath = asset('storage/'.$row->image_one);
                    $image = '<img src="'.$imagePath.'" height="100px" width="100px">';
                    return $image;
                })
                ->addColumn('action', function($row){
                    $admin = Admin::find(Auth::user()->id);
                    $btn = '';
                    if($admin->hasPermissionTo('Product edit')){
                        $editBtn = '<a href="'.route('admin.products.edit', $row->id).'" class="btn btn-primary btn-sm">Edit</a>';
                        $btn .= $editBtn;
                    }
                    if($admin->hasPermissionTo('Product delete')){
                        $deleteBtn = '<a href="'.route('admin.products.delete', $row->id).'" class="btn btn-danger btn-sm" data-confirm-delete="true">Delete</a>';
                        $btn .= ($btn ? ' ' : '') . $deleteBtn;
                    }
                    if ($row->status->id == 2) {
                        $approveBtn = '<button class="btn btn-warning btn-sm approve-product" data-product-id="'.$row->id.'">Approve</button>';
                        $btn .= ($btn ? ' ' : '') . $approveBtn;
                    }
                    return $btn;
                    
                })
                ->rawColumns(['image_one','action'])
                ->make(true);
      }

   }

}
