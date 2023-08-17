<?php

namespace Database\Seeders;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'admin', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'Admin',
        ]);
    
            // $role = Role::create(['name' => 'Admin']);
        
            $permissions = Permission::pluck('id','id')->all();
    
            $user->syncPermissions($permissions);
        
            $user->assignRole([$user->id]);
    }
}