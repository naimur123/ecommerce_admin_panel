<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GenericStatus;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
     //GetModel
     private function getModel(){
        return new Category();
    }

    //Get Datas
    public function index(Request $request){
        $categories = Category::all();
        $params =[
            
            "categories" => $categories
        ];

        
        // $admin = Session::get('admin');
        $this->saveActivity($request, "Category list viewed");
        return view('admin.category.categoryList',$params);
    }

    //create
    public function create(Request $request){
        $params = [
             "title"       =>   "Create",
             "statuses"    => GenericStatus::all(),
             "form_url"    => route('admin.category.store'),

        ];

        // $admin = Session::get('admin');
        $this->saveActivity($request, "Create category page opened");
        return view('admin.category.create',$params);
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
                    // if(Session::has('admin')){
                        $data->created_by = $request->user()->id;

                    // }
                    // $admin = Session::get('admin');
                    $this->saveActivity($request, "New category added");
                    
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = $request->user()->id;

                    $message = "category edited";
                    $msg = implode(' ', array($data->name, $message));
                    // $admin = Session::get('admin');
                    $this->saveActivity($request, $msg);
                }
    
                $data->name = $request->name;
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
                return back()->with("error", $this->getError($e))->withInput();
            }
    
            
            return back()->with("success", $request->id == 0 ? "Category Added Successfully" : "Category Updated Successfully");
    }

    //Catgeory edit
    public function edit(Request $request, $id){
        $category = Category::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.category.store'),
            // "categories" => Category::all(),
            "statuses"   => GenericStatus::all(),
            "data"       => $category

       ];

        //Activity message
        $message = "edit page opened";
        $msg = implode(' ', array($category->name, $message));
        // $admin = Session::get('admin');
        $this->saveActivity($request, $msg);

        return view('admin.category.create',$params);
    }

    // Category delete
    public function delete(Request $request, $id){

        try{
            $data = $this->getModel()->find($id);
            if(!empty($data)){
                $data->delete();
                $message = "deleted";
                $msg = implode(' ', array($data->name, $message));
                // $admin = Session::get('admin');
                $this->saveActivity($request, $msg);
            }
            
            return back();
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
    }

    public function getSubcategory(Request $request){
        $subcategory = SubCategory::where('category_id',$request->category_id)->get();
        if (count($subcategory) > 0) {
            return response()->json($subcategory);
            // dd($subcategory);
            
        }
        else{
            return 0;
        }
    }
}
