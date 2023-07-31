<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Console\VendorPublishCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class VendorController extends Controller
{
   //GetModel
        private function getModel(){
            return new Vendor();
        }

        //Get Datas
        // public function index(Request $request){
        //     $user = VendorPublishCommand::orderBy('id',"ASC");
        //     $user = $user->paginate(5);
        //     $params =[

        //         "title" => "List",
        //         "users" => $user
        //     ];

        //     $this->saveActivity($request, "Customer list viewed",);

        //     return view('admin.customer.customerList',$params);
        // }

        //vendor create
        public function create(Request $request){
            $params = [
                "title"       =>   "Vendor Create",
                "form_url"    => route('admin.vendor.store')
   
           ];
           return view('admin.vendor.create',$params);
        }


        //store
        public function store(Request $request){
            Validator::make(
                $request->all(),
                [
                    'name' => ['required','min:4'],
                    'password' => ['required','string','min:4','max:100'],
                    'email'    => ['required','email', $request->id == 0 ? 'unique:vendors' : Rule::unique('vendors')->ignore($request->id)],
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
                $data->password = !empty($request->password) ? bcrypt($request->password) : $data->password;
                if($request->has('picture')){
                    $picture = $request->file('picture');
                    $data->picture = $this->uploadImage($picture, $this->vendor);
                }
                $data->details = $request->details ? $this->htmlText($request->details) : $data->details;
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

        
        return back()->with("success", $request->id == 0 ? "Vendor Added Successfully" : "User Updated Successfully");
    }

    // pending vendor list
    public function pendingVendor(Request $request){
        $params = [
            "title"   => "Pending Vendor List",
            "vendors" => Vendor::where('is_approved',0)->get(),
            'url'     => route('admin.statusupdate.vendor')
        ];

        return view('admin.admin.pendingVendor',$params);
    }

    // status update
    public function statusupdate(Request $request){
        $status = $request->status_id;
        $vendor_id = $request->vendor_id;
        $vendor = Vendor::find($vendor_id);
        if($vendor){
            if($status == 1){
                try{
                    $vendor->is_approved = $status;
                    $vendor->approved_by = Auth::user()->id;
                    $vendor->save();

                    return back();

                }catch(Exception $e){

                }
            }
        }
    }
}
