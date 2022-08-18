<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;

class CustomerController extends Controller
{
    //GetModel
    private function getModel(){
        return new User();
    }

    //Get Datas
    public function index(Request $request){
        $user = User::orderBy('id',"ASC");
        $user = $user->paginate(5);
        $params =[

            "title" => "List",
            "users" => $user
        ];

        $this->saveActivity($request, "Customer list viewed",);

        return view('admin.customer.customerList',$params);
    }

     //store
     public function store(Request $request){
        Validator::make(
            $request->all(),
            [
                'name' => ['required','min:4'],
                'password' => ['required','string','min:4','max:100'],
                'email'    => ['required','email', $request->id == 0 ? 'unique:users' : Rule::unique('users')->ignore($request->id)],
                'phone'    => ['required','min:11','max:11']
    
            ]
           )->validate();
            
            try{
                DB::beginTransaction();
                if( $request->id == 0 ){
                    $data = $this->getModel(); 
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    
                }

                $data->name = $request->name;
                $data->email = $request->email;
                $data->phone = $request->phone;
                $data->password = $request->password;
                if($request->has('picture')){
                    $data->picture = $this->uploadImage($request, 'picture', $this->user,null,null,$data->picture);
                }
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
    
            
            return back()->with("success", $request->id == 0 ? "User Added Successfully" : "User Updated Successfully");
    }

    //customer edit
    public function edit(Request $request, $id){

        $user = User::find($id);

        $params = [
            "title"      => "Edit",
            "form_url"   => route('admin.customer.store'),
            "data"       => $user

       ];
       //Activity message
       $message = "edit page opened";
       $msg = implode(' ', array($user->name, $message));
      //$admin = Session::get('admin');
       $this->saveActivity($request, $msg);

       return view('admin.customer.create',$params);
    }

    //product Delete
    public function delete(Request $request, $id){

        try{
         $data = $this->getModel()->find($id);
         if(!empty($data)){
            $data->delete();
            $message = "customer archived";
            $msg = implode(' ', array($data->name, $message));
            $this->saveActivity($request, $msg);
         }
         return back();
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
    }

      //User archive list
      public function archive(Request $request){

        $user = $this->getModel()->onlyTrashed()->paginate(10);
        $params =[
            "title"  => "Deleted List",
            "users" => $user
        ];
       //$admin = Session::get('admin');
        $this->saveActivity($request,"Customer archive list viewed");
        return view('admin.customer.customerList',$params);
        
    }
    //User restore
    public function restore(Request $request, $id){

        try{
            $this->getModel()->onlyTrashed()->find($id)->restore();
           //$admin = Session::get('admin');
            $this->saveActivity($request,"Customer Restored");
            return redirect()->route('admin.customer')->with('success',"Customer restored successfully");
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        
        
    }
    //User permanent delete
    public function parmenentDelete(Request $request, $id){

        try{
          $user = $this->getModel()->onlyTrashed()->find($id);
          if(!empty($user)){
            $user->forceDelete();
            // $message = "Customer permanently deleted";
            // $msg = implode(' ', array($user->name, $message));
            // $this->saveActivity($request, $msg);
          }
          return redirect()->route('admin.customer.archive');
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
    }

}
