<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouponCode;
use App\Models\GenericStatus;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    //GetModel
    private function getModel(){
        return new CouponCode();
    }

    //Get Datas
    public function index(){
        $params =[
            
            "coupons" => CouponCode::all()
        ];

        return view('admin.coupon.couponList',$params);
    }

     //create
     public function create(){
        $params = [
             "title"       =>   "Create",
             "statuses"    => GenericStatus::all(),
             "form_url"    => route('admin.coupon.store')

        ];
        return view('admin.coupon.create',$params);
    }

    //store
    public function store(Request $request){
        Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2',
    
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
                // else{
                //     $data = $this->getModel()->find($request->id);
                //     $data->updated_by = Session::get('admin');
                // }
                $input = $request->name;
                $random = Str::random(4);
                $data->name = $input.''.$random;
                $data->value = $request->value ?? null;
                $data->start_date = $request->start_date ?? null;
                $data->start_time = $request->start_time ?? null;
                $data->end_date = $request->end_date ?? null;
                $data->end_time = $request->end_time ?? null;
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
    
            
            return back()->with("success", $request->id == 0 ? "Coupon Added Successfully" : "Coupon Updated Successfully");
    }
}
