<?php

namespace Modules\AuthManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ReciptientSeeder extends Seeder
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
              //patient
              'view patients',
              'add patient',
              'view patient by id',
              'edit patient',
              'delete patient',
  
              //medical record
              'view medical_records',
              'add medical_record',
              'view medical_record by id',
              'edit medical_record',
              'delete medical_record',
  
              // appointment
              'view appointments',
              'add appointment',
              'view appointment by id',
              'edit appointment',
              'delete appointment',
  
              //surgical operation
              'view surjical_operations',
              'add surjical_operation',
              'view surjical_operation by id',
              'edit surjical_operation',
              'delete surjical_operation',
        ];

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }
    }
}
