<?php

namespace Modules\AuthManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Modules\AuthManagement\Models\User;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'api',
        ]);

        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        $user = User::create([
            'name' => 'Super Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role_name' => 'SuperAdmin',
        ]);

        $user->assignRole('SuperAdmin');
    }
}
