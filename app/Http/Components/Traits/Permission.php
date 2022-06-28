<?php

namespace App\Http\Components\Traits;

use Illuminate\Support\Facades\Session;

trait Permission{
    
    /**
     * Check Permission
     */
    protected function hasPermission(...$key){
        
        $accesses = [];
        if(Session::has("group_access")){
            $accesses = Session::get("group_access");
        }else{
            $accesses = $admin->group_access;
        }
    }
}