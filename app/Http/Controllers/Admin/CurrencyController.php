<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\GenericStatus;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    //GetModel
    private function getModel(){
        return new Currency();
    }

    //Get Datas
    public function index(Request $request){
        $params =[
            
            "currencies" => Currency::all()
        ];

        $admin = Session::get('admin');
        $this->saveActivity($request, "Currency list viewed",$admin);

        return view('admin.currency.currencyList',$params);
    }
  
    //create
    public function create(Request $request){
      
        $params = [
             "title"       =>   "Create",
             "statuses"    => GenericStatus::all(),
             "countries"   => Country::all(),
             "symbols"      => $this->symbol(),
             "form_url"    => route('admin.currency.store')

        ];

        $admin = Session::get('admin');
        $this->saveActivity($request, "Create currency page opened",$admin);

        return view('admin.currency.create',$params);
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
                    $admin = Session::get('admin');
                    $this->saveActivity($request, "New currency added",$admin);
                    
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = Session::get('admin');

                    $message = "currency edited";
                    $msg = implode(' ', array($data->name, $message));
                    $admin = Session::get('admin');
                    $this->saveActivity($request, $msg, $admin);
                }
    
                $data->name = $request->name;
                $data->short_name = $request->short_name ?? null;
                $data->remarks = $request->remarks ?? null;
                $data->country_id = $request->country_id;
                $data->currency_symbol = $request->currency_symbol ?? null;
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
    
            
            return back()->with("success", $request->id == 0 ? "Currency Added Successfully" : "Currency Updated Successfully");
    }

    //Currency edit
    public function edit(Request $request, $id){
        $currency = Currency::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.currency.store'),
            "statuses"   => GenericStatus::all(),
            "countries"   => Country::all(),
            "symbols"      => $this->symbol(),
            "data"       => $currency

       ];

       //Activity message
       $message = "edit page opened";
       $msg = implode(' ', array($currency->name, $message));
       $admin = Session::get('admin');
       $this->saveActivity($request, $msg, $admin);

       return view('admin.currency.create',$params);
    }

    // Currency delete
    public function delete(Request $request, $id){

        try{
            $data = $this->getModel()->find($id);
            if(!empty($data)){
                $data->delete();
                $message = "currency deleted";
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
