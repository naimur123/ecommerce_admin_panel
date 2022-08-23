<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    //GetModel
    private function getModel(){
        return new Admin();
    }

    //Get Datas
    public function index(Request $request){
        $admin = Admin::all();
        // $activity = $activity->paginate(50);
        
        $params =[
            
            "admins" => $admin
        ];

        // $admin = Session::get('admin');
        $this->saveActivity($request, "Admin list viewed");

        return view('admin.admin.adminList',$params);
    }

    //get permissions
    public function permission(Request $request){

        $role = Role::all();
        $permission = Permission::all();
        // $permission = Permission::orderBy('group_name')->get();
        // dd($permission);
        $admin = Admin::find($request->id);
        // $admin->getPermissionsViaRoles()->toArray();
        // dd($admin);
        $params= [
            "roles"       => $role,
            "permissions" => $permission,
            "admin"       => $admin,
            "form_url"    => route('admin.permisssion.store')

        ];

        return view('admin.permission.create',$params);
       
    }

    public function permissionStore(Request $request){

        try{
            $admin = Admin::find($request->admin);
            // dd($admin);
            $role = $admin->assignRole($request->name);
            // dd($request->name);
            $permissions = $request->input('permissions');
            if (!empty($permissions)) {
                $role->givePermissionTo($permissions);
            }
    
            return back()->with('success',"Permission added");
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        

    }
}
