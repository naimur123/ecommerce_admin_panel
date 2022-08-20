<?php

namespace App\Providers;

use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // view()->composer('test', function ($view) {

        // });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //  $this->setAdminRole();
        // View::composer('test', function ($view) {
        //     echo "HI";
        // });
    }

     /**
     * Set Admin Rule
     */
    protected function setAdminRole(){
        try{
            // $user = Admin::where('id',1)->get();
            // $name = Role::where('name',"superadmin")->get();
       
            // $user->assignRole($name);
            
        }catch(Exception $e){

        }
    }
}
