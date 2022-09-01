<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role create
        $roleSuperAdmin = Role::create(['name' => 'superadmin','guard_name' =>'admin']);
        $roleAdmin = Role::create(['name' => 'admin','guard_name' =>'admin']);
        $roleUser = Role::create(['name' => 'user']);

         // Permission List as array
         $permissions = [
            [
                'group_name' => 'Dashboard',
                'permissions' => [
                    'Dashboard view',
                ]
            ],
            [
                'group_name' => 'Admin',
                'permissions' => [
                    // admin Permissions
                    'Admin create',
                    'Admin view',
                    'Admin edit',
                    'Admin delete',
                ]
            ],
            [
                'group_name' => 'Customer',
                'permissions' => [
                    //customer Permissions
                    'Customer create',
                    'Customer view',
                    'Customer edit',
                    'Customer delete',
                ]
            ],
            [
                'group_name' => 'Order',
                'permissions' => [
                    //customer Permissions
                    'Order create',
                    'Order view',
                    'Order edit',
                    'Order delete',
                ]
            ],
            [
                'group_name' => 'Product',
                'permissions' => [
                    //product Permissions
                    'Product create',
                    'Product view',
                    'Product edit',
                    'Product delete',
                ]
            ],
            [
                'group_name' => 'Category',
                'permissions' => [
                    //category Permissions
                    'Category create',
                    'Category view',
                    'Category edit',
                    'Category delete',
                ]
            ],
            [
                'group_name' => 'Subcategory',
                'permissions' => [
                    //subcategory Permissions
                    'Subcategory create',
                    'Subcategory view',
                    'Subcategory edit',
                    'Subcategory delete',
                ]
            ],
            [
                'group_name' => 'Brand',
                'permissions' => [
                    //brand Permissions
                    'Brand create',
                    'Brand view',
                    'Brand edit',
                    'Brand delete',
                ]
            ],
            [
                'group_name' => 'Country',
                'permissions' => [
                    //country permissions
                    'Country create',
                    'Country view',
                    'Country edit',
                    'Country delete',
                ]
            ],
            [
                'group_name' => 'Currency ',
                'permissions' => [
                    //Currency  permissions
                    'Currency create',
                    'Currency view',
                    'Currency edit',
                    'Currency delete',
                ]
            ],
            [
                'group_name' => 'Unit',
                'permissions' => [
                    //unit permissions
                    'Unit create',
                    'Unit view',
                    'Unit edit',
                    'Unit delete',
                ]
            ],
            [
                'group_name' => 'Coupon',
                'permissions' => [
                    //coupon permissions
                    'Coupon create',
                    'Coupon view',
                    'Coupon edit',
                    'Coupon delete',
                ]
            ],
            [
                'group_name' => 'Slider',
                'permissions' => [
                    //slider Permissions
                    'Slider create',
                    'Slider view',
                    'Slider edit',
                    'Slider delete',
                ]
            ],
            [
                'group_name' => 'Status',
                'permissions' => [
                    //status Permissions
                    'Status create',
                    'Status view',
                    'Status edit',
                    'Status delete',
                ]
            ],
            [
                'group_name' => 'Emailsetup',
                'permissions' => [
                    //Emailsetup Permissions
                    'Emailsetup create',
                    'Emailsetup view',
                    'Emailsetup edit',
                    'Emailsetup delete',
                ]
            ],
            [
                'group_name' => 'Activitylog',
                'permissions' => [
                    //Activitylog Permissions
                    'Activitylog view',
                    'Activitylog delete',
                ]
            ],
            [
                'group_name' => 'Website',
                'permissions' => [
                    //Website Permissions
                    'Website view',
                    'Website edit',
                ]
            ],
            [
                'group_name' => 'Permission',
                'permissions' => [
                    //Activitylog Permissions
                    'Permission view',
                    'Permission create',
                    'Permission edit',
                    'Permission delete'
                ]
            ],
        ];

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'guard_name'=>'admin', 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);

               
            }
        }
        $user =  Admin::create([
            "name"              => "Super Admin",
            "email"             => "admin@admin.com",
            "password"          => bcrypt("admin@admin.com"),
            "email_verified_at" => now(),
            "remember_token"    => Str::random(32),
        ]);
        $user->assignRole($roleSuperAdmin);
    }
}
