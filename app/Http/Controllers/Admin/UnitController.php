<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GenericStatus;
use App\Models\Unit;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
     //GetModel
     private function getModel(){
        return new Unit();
    }

     //Get Datas
     public function index(Request $request){
        $params =[
            
            "units" => Unit::all()
        ];

        $admin = Session::get('admin');
        $this->saveActivity($request, "Unit list viewed",$admin);


        return view('admin.unit.unitList',$params);
    }

    //create
    public function create(Request $request){
        $params = [
             "title"       =>   "Create",
             "statuses"    => GenericStatus::all(),
             "form_url"    => route('admin.unit.store')

        ];

        $admin = Session::get('admin');
        $this->saveActivity($request, "Unit create page opened",$admin);

        return view('admin.unit.create',$params);
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
                    $this->saveActivity($request, "New unit added",$admin);
                    
                    
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = Session::get('admin');

                    $message = "unit edited";
                    $msg = implode(' ', array($data->name, $message));
                    $admin = Session::get('admin');
                    $this->saveActivity($request, $msg, $admin);
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
    
            
        return redirect()->route('admin.unit');
    }

    //Unit edit
    public function edit(Request $request, $id){
        $unit = Unit::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.unit.store'),
            "statuses"   => GenericStatus::all(),
            "data"       => $unit

       ];

       //Activity message
       $message = "edit page opened";
       $msg = implode(' ', array($unit->name, $message));
       $admin = Session::get('admin');
       $this->saveActivity($request, $msg, $admin);

       return view('admin.unit.create',$params);
    }

    //Unit delete
    public function delete(Request $request, $id){

        try{
            $data = $this->getModel()->find($id);
            if(!empty($data)){
                $data->delete();
                $message = "unit deleted";
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
