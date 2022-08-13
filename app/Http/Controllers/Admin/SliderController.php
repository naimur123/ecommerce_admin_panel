<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GenericStatus;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Exception;

class SliderController extends Controller
{
    //GetModel
    private function getModel(){
        return new Slider();
    }

    //Get Datas
    public function index(Request $request){
        $params =[
            "title" => "List",
            "sliders" => Slider::all()
        ];
        $admin = Session::get('admin');
        $this->saveActivity($request, "Slider list viewed",$admin);

        return view('admin.slider.sliderList',$params);
    }

    //create
    public function create(Request $request){
        $params = [
             "title"       => "Create",
             "form_url"    => route('admin.slider.store'),
             "statuses"     => GenericStatus::all()

        ];
        $admin = Session::get('admin');
        $this->saveActivity($request, "Slider create page opened",$admin);
        return view('admin.slider.create',$params);
    }
    //store product
    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|min:2',
    
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
                    $this->saveActivity($request, "New slider added",$admin);
                    
                    
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = Session::get('admin');

                    $message = "slider edited";
                    $msg = implode(' ', array($data->title, $message));
                    $admin = Session::get('admin');
                    $this->saveActivity($request, $msg, $admin);
                }
    
                $data->title = $request->title ?? null;
                $data->description = $request->description ?? null;
                $data->image = $this->uploadImage($request, 'image', $this->slider, null,null, $data->image);
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
                return back()->with("error", $this->getError($e))->withInput();
            }
        return back()->with("success", $request->id == 0 ? "Slider Added Successfully" : "Slider Updated Successfully");
    }

     //slider edit
     public function edit(Request $request, $id){

        $slider = Slider::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.slider.store'),
            "statuses"   => GenericStatus::all(),
            "data"       => $slider

       ];
       //Activity message
       $message = "edit page opened";
       $msg = implode(' ', array($slider->name, $message));
       $admin = Session::get('admin');
       $this->saveActivity($request, $msg, $admin);

       return view('admin.slider.create',$params);
    }

     //product Delete
     public function delete(Request $request, $id){

        try{
         $data = $this->getModel()->find($id);
         if(!empty($data)){
            $data->delete();
            $message = "slider archived";
            $msg = implode(' ', array($data->name, $message));
            $admin = Session::get('admin');
            $this->saveActivity($request, $msg, $admin);
            return back()->with('success',"Slider archived");
         }
         
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
    }

}
