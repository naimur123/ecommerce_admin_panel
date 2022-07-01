<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\GenericStatus;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
     //GetModel
     private function getModel(){
        return new Country();
    }

    //Get Datas
    public function index(){
        // $categories = Category::all();
        $params =[
            
            "countries" => Country::all()
        ];

        // print_r($products);

        return view('admin.country.countryList',$params);
    }

    //create
    public function create(){
        $params = [
             "title"       =>   "Create",
             "statuses"    => GenericStatus::all(),
             "form_url"    => route('admin.country.store')

        ];
        return view('admin.country.create',$params);
    }

    //store
    public function store(Request $request){
        Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2',
                'short_name' => 'nullable|min:2',
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
                $data->short_name = $request->short_name ?? null;
                $data->remarks = $request->remarks ?? null;
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
    
            
        return redirect()->route('admin.country');
    }

     //Country edit
     public function edit($id){
        $country = Country::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.country.store'),
            "statuses"   => GenericStatus::all(),
            "data"       => $country

       ];
       return view('admin.country.create',$params);
    }
}
