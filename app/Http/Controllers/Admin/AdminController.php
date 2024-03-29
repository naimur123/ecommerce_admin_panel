<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;

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

    //Admin create
    public function create(Request $request){
        $params = [
             "title"       =>   "Create",
             "form_url"    => route('admin.admin.store')

        ];
        $this->saveActivity($request, "Create admin page opened");
        return view('admin.admin.create',$params);
    }

    // Admin store
    public function store(Request $request){

        Validator::make(
            $request->all(),
            [
                'name' => ['required','min:4'],
                'password' => ['required','string','min:4','max:100'],
                'email'    => ['required','email', $request->id == 0 ? 'unique:admins' : Rule::unique('admins')->ignore($request->id)],
                'phone'    => ['required','min:11','max:11']
    
            ]
           )->validate();
            
            try{
                DB::beginTransaction();
                if( $request->id == 0 ){
                    $data = $this->getModel();
                    $data->created_by = $request->user()->id; 
                }
                else{
                    $data = $this->getModel()->find($request->id);
                    $data->updated_by = $request->user()->id;
                    
                }

                $data->name = $request->name;
                $data->email = $request->email;
                $data->phone = $request->phone;
                $data->password = !empty($request->password) ? bcrypt($request->password) : $data->password;
                if($request->has('image')){
                    $image = $request->file('image');
                    $data->image = $this->uploadImage($image, $this->admin);
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
    
            
            return back()->with("success", $request->id == 0 ? "Admin Added Successfully" : "Admin Updated Successfully");
    }

    // Admin edit
    public function edit(Request $request){

        $admin = Admin::find($request->id);

        $params = [
             "title"       =>   "Edit",
             "form_url"    => route('admin.admin.store'),
             "data"        => $admin

        ];
        $this->saveActivity($request, "Edit admin page opened");
        return view('admin.admin.create',$params);
    }

    //create new permisssion
    public function createPermission(Request $request){
        $params =[
           "title" => "Create Permission",
           "form_url" => route('admin.permisssion.add')
        ];
        return view('admin.admin.createPermission',$params);
    }

    //store new permission
    public function addPermission(Request $request){

        try{
            $permission = new Permission();
            $permission->name = $request->name;
            $permission->guard_name = 'vendor';
            $permission->group_name = $request->group_name;
            $permission->save();
            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
            return back()->with("error", $this->getError($e))->withInput();
        }
        return back()->with("success","Permission Added Successfully");
    }

    //get permissions
    public function permission(Request $request){

        $role = Role::where('guard_name','admin')->get();
        // dd($role);
        $permission = Permission::all();
        // $permission = Permission::orderBy('group_name')->get();
        // dd($permission);
        $admin = Admin::find($request->id);


        // $permission = $admin->permissions;
        // dd($admin->getRoleNames());
        // $admin->getPermissionsViaRoles()->toArray();
        // dd($admin);
        $params= [
            "roles"       => $role,
            "permissions" => $permission,
            // "hasPermissions" => $hasPermission ?? [],
            "admin"       => $admin,
            "form_url"    => route('admin.permisssion.store')

        ];

        return view('admin.permission.create',$params);
       
    }

    public function permissionStore(Request $request){

        try{
            $admin = Admin::find($request->admin);
            $role = $admin->assignRole($request->name);
            $permissions = $request->input('permissions');
           
            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }
            else{
                return back()->with('error',"At least one permission needed");
            }
    
            return back()->with('success',"Permission added");
        }catch(Exception $e){
            return back()->with("error", $this->getError($e))->withInput();
        }
        

    }
}
