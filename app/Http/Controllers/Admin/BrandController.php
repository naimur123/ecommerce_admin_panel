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
    public function index(){
        $params =[
            
            "brands" => Brand::all()
        ];

        return view('admin.brand.brandList',$params);
    }

    //create
    public function create(){
        $params = [
             "title"       =>   "Create",
             "countries"   => Country::all(),
             "statuses"    => GenericStatus::all(),
             "form_url"    => route('admin.brand.store')

        ];
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
                    
                    
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = Session::get('admin');
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
     public function edit($id){
        $brand = Brand::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.brand.store'),
            "countries" => Country::all(),
            "statuses"   => GenericStatus::all(),
            "data"       => $brand

       ];
       return view('admin.brand.create',$params);
    }
}
