<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use App\Models\ShippingAddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OthersController extends Controller
{
    //payment type page
    public function createPtype(Request $request){
        $params =[
            "title"   => "Payment type create",
            "form_url" => route('admin.others.paymenttype.store'),

        ];
        return view('admin.others.paymentType', $params);
    }

    //store payment type
    public function storePtype(Request $request){
        try{
            $type = new PaymentType();
            $type->name = $request->name;
            $type->details = $request->details;
            $type->save();

            DB::commit();

        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        return back()->with('success',"Payment type added");
    }

    //create division
    public function createDivision(Request $request){
        $params=[
            "form_url" => route('admin.others.division.create'),
            "title"    => "Division create"
        ];
        return view('admin.others.division',$params);
    }

    //store division
    public function storeDivision(Request $request){
        try{
            $data = new ShippingAddress();
            $data->division = $request->division;

            $data->save();

            DB::commit();

        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        return back()->with('success',"Shipping address added");
    }

}
