<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Country;
use App\Models\GenericStatus;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class BrandController extends Controller
{
    //GetModel
    private function getModel(){
        return new Brand();
    }

    //Get Datas
    public function index(Request $request){
        $params =[
            
            "brands" => Brand::all()
        ];
        $admin = Session::get('admin');
        $this->saveActivity($request, "Barnd list viewed",$admin);
        return view('admin.brand.brandList',$params);
    }

    //create
    public function create(Request $request){
        $params = [
             "title"       =>   "Create",
             "countries"   => Country::all(),
             "statuses"    => GenericStatus::all(),
             "form_url"    => route('admin.brand.store')

        ];
        $admin = Session::get('admin');
        $this->saveActivity($request, "Create brand page opened",$admin);
        return view('admin.brand.create',$params);
    }

    //store
    public function store(Request $request){
        Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2',
                'remarks' => 'nullable|min:4',
    
            ]
           )->validate();
            
            try{
                DB::beginTransaction();
                if( $request->id == 0 ){
                    $data = $this->getModel();
                    if(Session::has('admin')){
                        $data->created_by = Session::get('admin');
                    }
                    
                    $admin = Session::get('admin');
                    $this->saveActivity($request, "New brand added",$admin);
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = Session::get('admin');

                    $message = "edited";
                    $msg = implode(' ', array($data->name, $message));
                    $admin = Session::get('admin');
                    $this->saveActivity($request, $msg, $admin);
                }
    
               $data->name = $request->name;
               $data->image = $this->uploadImage($request, 'image', $this->brand, null, null,$data->image) ?? null;
               $data->remarks = $request->remarks;
               $data->country_id = $request->country_id;
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
    
            
        return redirect()->route('admin.brand');
    }

     //Catgeory edit
     public function edit(Request $request, $id){
       
        $brand = Brand::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.brand.store'),
            "countries" => Country::all(),
            "statuses"   => GenericStatus::all(),
            "data"       => $brand

       ];

       //Activity message
       $message = "edit page opened";
       $msg = implode(' ', array($brand->name, $message));
       $admin = Session::get('admin');
       $this->saveActivity($request, $msg, $admin);

       return view('admin.brand.create',$params);
    }

    // Brand delete
    public function delete(Request $request, $id){

        try{
            $data = $this->getModel()->find($id);
            if(!empty($data)){
                $data->delete();
                $message = "deleted";
                $msg = implode(' ', array($data->name, $message));
                $admin = Session::get('admin');
                $this->saveActivity($request, $msg, $admin);
            }
            
            return back();
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
    }
}
