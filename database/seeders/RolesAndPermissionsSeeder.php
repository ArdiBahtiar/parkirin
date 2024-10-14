<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create Roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Owner']);
        Role::create(['name' => 'User']);
        
        // Create Permissions
        Permission::create(['name' => 'view post']);
        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'delete post']);

        // Assign Role to User
        $user = User::find(1); // Replace 1 with the actual user ID
        $user->assignRole('Admin');

        // Assign Permissions to Role
        $adminRole = Role::findByName('Admin');
        $adminRole->givePermissionTo('view post');
    }
}
