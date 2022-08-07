<?php

namespace App\Http\Components\Traits;

use App\Models\ActivityLog as AppActivityLog;
use App\Models\Admin;
use Exception;

trait ActivityLog{
    /**
     * Add Admin Activity Log
     */
    protected function saveActivity($request, $activity,$admin){
        try{
            
            $activity_log = new AppActivityLog();
            $name = "";
            $admin = Admin::find($admin);
            if(!empty($admin)){
                $name = $admin->name;
                $activity_log->admin_id = $admin->id;
            }
            $activity_log->mac = exec('getmac');
            $activity_log->ip = $request->ip();
            $activity = trim($activity, "open");
            $activity = trim($activity, "Open");
            $activity = ucfirst(strtolower($activity));
            $activity_log->activity = $activity . ' by ' . $name;
            
            $activity_log->save();
        }catch(Exception $e){
            //
        }
    }
}