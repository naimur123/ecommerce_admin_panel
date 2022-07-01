<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\SubCategory;
use App\Models\Category;
Use App\Models\GenericStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    //GetModel
    private function getModel(){
        return new SubCategory();
    }

     //Get Datas
     public function index(){
        // $categories = Category::all();
        $params =[
            
            "subcategories" => SubCategory::all()
        ];

        // print_r($products);

        return view('admin.subcategory.subcategoryList',$params);
    }

    //create
    public function create(){
        $params = [
             "title"       =>   "Create",
             "categories"  => Category::all(),
             "statuses"    => GenericStatus::all(),
             "form_url"    => route('admin.subcategory.store'),

        ];
        return view('admin.subcategory.create',$params);
    }

    //store
    public function store(Request $request){
        Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2',
                'remarks' => 'nullable|min:4',
                'details' => 'nullable|min:4',
    
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
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = Session::get('admin');
                }
    
                $data->name = $request->name;
                $data->category_id = $request->category_id;
                $data->details = $request->details ?? "";
                $data->remarks = $request->remarks ?? "";
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
                return back();
                // return back()->with("error", $this->getError($e))->withInput();
            }
    
            
        return redirect()->route('admin.subcategory');
    }

    //SubCatgeory edit
    public function edit($id){
        $subcategory = SubCategory::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.subcategory.store'),
            // "subcategories" => SubCategory::all(),
            "categories" => Category::all(),
            "statuses"   => GenericStatus::all(),
            "data"       => $subcategory

       ];
       return view('admin.subcategory.create',$params);
    }
}
