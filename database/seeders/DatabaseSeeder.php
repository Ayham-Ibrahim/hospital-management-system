<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\DoctorManagement\Models\Doctor;
use Modules\DepartmentManagement\Models\Room;
use Modules\PatientManagement\Models\Patient;
use Modules\DepartmentManagement\Models\Service;
use Modules\DepartmentManagement\Models\Department;
use Modules\AuthManagement\Database\Seeders\PermissionSeeder;
use Modules\AuthManagement\Database\Seeders\SuperAdminSeeder;
use Modules\AuthManagement\Database\Seeders\DoctorManagerSeeder;
use Modules\DepartmentManagement\Database\Seeders\DepartmentSeeder;
use Modules\AuthManagement\Database\Seeders\DepartmentManagerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Department::factory()->count(10)->create();

        Room::factory()->count(10)->create();

        Service::factory()->count(10)->create();

        Patient::factory()->count(10)->create();

        // Doctor::factory()->count(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // DepartmentSeeder::class,
            PermissionSeeder::class,
            SuperAdminSeeder::class,
            DepartmentManagerSeeder::class,
            DoctorManagerSeeder::class,
        ]);
    }
}
