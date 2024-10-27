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
