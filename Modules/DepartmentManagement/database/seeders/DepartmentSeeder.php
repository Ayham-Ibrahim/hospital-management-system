<?php

namespace Modules\DepartmentManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\DepartmentManagement\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);

        Department::create([
            'name' =>"hello",
            'description' =>"hello",
            'phone_number' =>"435435345"
        ]);
        Department::create([
            'name' =>"nne",
            'description' =>"heladasdlo",
            'phone_number' =>"435435345"
        ]);
        Department::create([
            'name' =>"ewqeqwe",
            'description' =>"heldasdlo",
            'phone_number' =>"435435345"
        ]);

    }
}
