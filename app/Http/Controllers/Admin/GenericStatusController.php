<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GenericStatus;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class GenericStatusController extends Controller
{
    //GetModel
    private function getModel(){
        return new GenericStatus();
    }

    //Get Datas
    public function index(Request $request){
        
        $params =[
            
            "statuses" => GenericStatus::all()
        ];

        $admin = Session::get('admin');
        $this->saveActivity($request, "Generic Status list viewed",$admin);

        return view('admin.genericStatus.statusList',$params);
    }

    //create
    public function create(Request $request){
        $params = [
             "title"       =>   "Create",
             "form_url"    => route('admin.status.store'),

        ];
        $admin = Session::get('admin');
        $this->saveActivity($request, "Create generic status page opened",$admin);

        return view('admin.genericStatus.create',$params);
    }

    //store
    public function store(Request $request){
        Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2',
                'short_name' => 'nullable|min:1',
    
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
                    $this->saveActivity($request, "New generic status added",$admin);
                    
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = Session::get('admin');

                    $message = "generic status edited";
                    $msg = implode(' ', array($data->name, $message));
                    $admin = Session::get('admin');
                    $this->saveActivity($request, $msg, $admin);
                }
    
                $data->name = $request->name;
                $data->short_name = $request->short_name ?? null ;
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
    
            
            return back()->with("success", $request->id == 0 ? "Status Added Successfully" : "Status Updated Successfully");
    }

     //Status edit
     public function edit(Request $request, $id){
        $status = GenericStatus::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.status.store'),
            "data"       => $status

       ];

       //Activity message
       $message = "edit page opened";
       $msg = implode(' ', array($status->name, $message));
       $admin = Session::get('admin');
       $this->saveActivity($request, $msg, $admin);

       return view('admin.genericStatus.create',$params);
    }
}
