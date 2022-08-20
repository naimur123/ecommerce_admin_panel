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
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                ]
            ],
            [
                'group_name' => 'admin',
                'permissions' => [
                    // admin Permissions
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                ]
            ],
            [
                'group_name' => 'customer',
                'permissions' => [
                    //customer Permissions
                    'customer.create',
                    'customer.view',
                    'customer.edit',
                    'customer.delete',
                ]
            ],
            [
                'group_name' => 'product',
                'permissions' => [
                    //product Permissions
                    'product.create',
                    'product.view',
                    'product.edit',
                    'product.delete',
                ]
            ],
            [
                'group_name' => 'category',
                'permissions' => [
                    //category Permissions
                    'category.create',
                    'category.view',
                    'category.edit',
                    'category.delete',
                ]
            ],
            [
                'group_name' => 'subcategory',
                'permissions' => [
                    //subcategory Permissions
                    'subcategory.create',
                    'subcategory.view',
                    'subcategory.edit',
                    'subcategory.delete',
                ]
            ],
            [
                'group_name' => 'brand',
                'permissions' => [
                    //brand Permissions
                    'brand.create',
                    'brand.view',
                    'brand.edit',
                    'brand.delete',
                ]
            ],
            [
                'group_name' => 'country',
                'permissions' => [
                    //country permissions
                    'country.create',
                    'country.view',
                    'country.edit',
                    'country.delete',
                ]
            ],
            [
                'group_name' => 'currency',
                'permissions' => [
                    //currency permissions
                    'currency.create',
                    'currency.view',
                    'currency.edit',
                    'currency.delete',
                ]
            ],
            [
                'group_name' => 'unit',
                'permissions' => [
                    //unit permissions
                    'unit.create',
                    'unit.view',
                    'unit.edit',
                    'unit.delete',
                ]
            ],
            [
                'group_name' => 'coupon',
                'permissions' => [
                    //coupon permissions
                    'coupon.create',
                    'coupon.view',
                    'coupon.edit',
                    'coupon.delete',
                ]
            ],
            [
                'group_name' => 'slider',
                'permissions' => [
                    //slider Permissions
                    'slider.create',
                    'slider.view',
                    'slider.edit',
                    'slider.delete',
                ]
            ],
            [
                'group_name' => 'status',
                'permissions' => [
                    //status Permissions
                    'status.create',
                    'status.view',
                    'status.edit',
                    'status.delete',
                ]
            ],
            [
                'group_name' => 'emailsetup',
                'permissions' => [
                    //emailsetup Permissions
                    'emailsetup.create',
                    'emailsetup.view',
                    'emailsetup.edit',
                    'emailsetup.delete',
                ]
            ],
            [
                'group_name' => 'activitylog',
                'permissions' => [
                    //activitylog Permissions
                    'activitylog.view',
                    'activitylog.delete',
                ]
            ],
            [
                'group_name' => 'website',
                'permissions' => [
                    //activitylog Permissions
                    'website.view',
                    'website.edit',
                ]
            ],
            [
                'group_name' => 'permission',
                'permissions' => [
                    //activitylog Permissions
                    'permission.view',
                    'permission.create',
                    'permission.edit',
                    'permission.delete'
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
        $user2 =  Admin::create([
            "name"              => "Admin",
            "email"             => "admin1@admin.com",
            "password"          => bcrypt("admin1@admin.com"),
            "email_verified_at" => now(),
            "remember_token"    => Str::random(32),
        ]);
        // $name = Role::where('name',"superadmin")->get();
           
        $user->assignRole($roleSuperAdmin);
        $user2->assignRole($roleAdmin);
        $user2->givePermissionTo(10);
        
    

    }
}
