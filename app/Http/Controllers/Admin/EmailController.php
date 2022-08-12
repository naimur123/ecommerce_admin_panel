<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Exception;

class EmailController extends Controller
{
     //GetModel
     private function getModel(){
        return new EmailTemplate();
    }

     //create
     public function create(){
        $params = [
             "title"       =>   "Configure",
             "form_url"    => route('admin.emailtemplate.store')

        ];
        return view('admin.email.template',$params);
    }

    //store
    public function store(Request $request){
        Validator::make(
            $request->all(),
            [
                'type' => 'required|min:2',
    
            ]
           )->validate();
            
            try{
               
                $data = new EmailTemplate();
                $data->type = $request->type;
                $data->subject = $request->subject;
                $data->body = $request->body;
                $data->footer = $request->footer;
                $data->send_email = $request->send_email;
                $data->save();
                
                return back()->with("success","Email Template Added Successfully");
                
            }catch(Exception $e){
                
                return back()->with("error", $this->getError($e))->withInput();
            }
    
            
       
    }
}
