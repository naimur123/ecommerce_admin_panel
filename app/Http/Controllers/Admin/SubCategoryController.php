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
     public function index(Request $request){
        // $categories = Category::all();
        $params =[
            
            "subcategories" => SubCategory::all()
        ];

        //$admin = Session::get('admin');
        $this->saveActivity($request, "Subcategory list viewed");

        return view('admin.subcategory.subcategoryList',$params);
    }

    //create
    public function create(Request $request){
        $params = [
             "title"       =>   "Create",
             "categories"  => Category::all(),
             "statuses"    => GenericStatus::all(),
             "form_url"    => route('admin.subcategory.store'),

        ];

        //$admin = Session::get('admin');
        $this->saveActivity($request, "Subcategory create page opened");

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
                    // if(Session::has('admin')){
                        $data->created_by = $request->user()->id;
                    // }
                    //$admin = Session::get('admin');
                    $this->saveActivity($request, "New subcategory added");
                    
                    
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = $request->user()->id;

                    $message = "subcategory edited";
                    $msg = implode(' ', array($data->name, $message));
                    //$admin = Session::get('admin');
                    $this->saveActivity($request, $msg);
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
                return back()->with("error", $this->getError($e))->withInput();
            }
    
            
            return back()->with("success", $request->id == 0 ? "Subcategory Added Successfully" : "Subcategory Updated Successfully");
    }

    //SubCatgeory edit
    public function edit(Request $request, $id){
        $subcategory = SubCategory::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.subcategory.store'),
            // "subcategories" => SubCategory::all(),
            "categories" => Category::all(),
            "statuses"   => GenericStatus::all(),
            "data"       => $subcategory

       ];

       //Activity message
       $message = "edit page opened";
       $msg = implode(' ', array($subcategory->name, $message));
       //$admin = Session::get('admin');
       $this->saveActivity($request, $msg);

       return view('admin.subcategory.create',$params);
    }

    //SubCategory delete
    public function delete(Request $request, $id){

        try{
            $data = $this->getModel()->find($id);
            if(!empty($data)){
                $data->delete();
                $message = "subcategory deleted";
                $msg = implode(' ', array($data->name, $message));
                //$admin = Session::get('admin');
                $this->saveActivity($request, $msg);
            }
            
            return back();
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
    }
}
