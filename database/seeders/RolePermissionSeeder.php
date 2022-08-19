<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        $roleAdmin = Role::create(['name' => 'admin']);
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
                'group_name' => 'slider',
                'permissions' => [
                    //slider Permissions
                    'slider.create',
                    'slider.view',
                    'slider.edit',
                    'slider.delete',
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
    

    }
}
