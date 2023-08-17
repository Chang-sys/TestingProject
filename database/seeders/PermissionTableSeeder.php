<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

           'product-list',
           'product-create',
           'product-edit',
           'product-delete',

           'user-list',
           'user-create',
           'user-edit',
           'user-delete',

           'brand-create',
           'brand-list',
           'brand-edit',
           'brand-delete',
        ];
     
        foreach ($permissions as $permission) {
            $old_permission = Permission::where('name', $permission)->first();
            if(!$old_permission) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}