<?php

namespace Modules\AuthManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // role
            'view roles',
            'add role',
            'view role by id',
            'edit role',
            'delete role',

            //permission
            'view permissions',
            'add permission',
            'view permission by id',
            'edit permission',
            'delete permission',

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
            // Check if the permission already exists to avoid duplication
            $existingPermission = Permission::where('name', $permission)->where('guard_name', 'api')->first();

            if (!$existingPermission) {
                Permission::create(['guard_name' => 'api', 'name' => $permission]);
            }
        }
    }
}
