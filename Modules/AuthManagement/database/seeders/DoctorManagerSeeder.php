<?php

namespace Modules\AuthManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DoctorManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Doctors Manager',
            'guard_name' => 'api',
        ]);

         // Assign permissions to the User role
         $permissions = [
              //doctors
              'view doctors',
              'add doctor',
              'view doctor by id',
              'edit doctor',
              'delete doctor',
  
              //doctor shift
              'view doctor_shift',
              'add doctor_shift',
              'view doctor_shift by id',
              'edit doctor_shift',
              'delete doctor_shift',

        ];

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }
    }
}
