<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ActivityLogController extends Controller
{
    //GetModel
    private function getModel(){
        return new ActivityLog();
    }

     //Get Datas
     public function index(Request $request){
        $params =[
            
            "activities" => ActivityLog::all()
        ];
        $admin = Session::get('admin');
        $this->saveActivity($request, "Activity Log viewed",$admin);
        return view('admin.activity.activityList',$params);
    }
}
