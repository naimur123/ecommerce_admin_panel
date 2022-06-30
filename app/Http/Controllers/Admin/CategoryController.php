<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GenericStatus;
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
    public function index(){
        $categories = Category::all();
        $params =[
            
            "categories" => $categories
        ];

        // print_r($products);

        return view('admin.category.categoryList',$params);
    }
    //create
    public function create(){
        $params = [
             "title"       =>   "Create",
             "statuses"    => GenericStatus::all(),
             "form_url"    => route('admin.category.store'),

        ];
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
                    if(Session::has('admin')){
                        $data->created_by = Session::get('admin');
                    }
                    
                    
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = Session::get('admin');
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
                return back();
                // return back()->with("error", $this->getError($e))->withInput();
            }
    
            
        return redirect()->route('admin.category');
    }

    //Catgeory edit
    public function edit($id){
        $product = Category::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.category.store'),
            "categories" => Category::all(),
            "statuses"   => GenericStatus::all(),
            "data"       => $product

       ];
       return view('admin.category.create',$params);
    }
}
