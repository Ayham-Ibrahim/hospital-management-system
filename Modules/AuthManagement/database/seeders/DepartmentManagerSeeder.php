<?php

namespace Modules\AuthManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DepartmentManagerSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Departments Manager',
            'guard_name' => 'api',
        ]);

         // Assign permissions to the User role
         $permissions = [
           //department
           'view departments',
           'add department',
           'view department by id',
           'edit department',
           'delete department',

           //room
           'view rooms',
           'add room',
           'view room by id',
           'edit room',
           'delete room',

           //services
           'view services',
           'add service',
           'view service by id',
           'edit service',
           'delete service',

        ];

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

    }
}
