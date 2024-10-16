<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\DepartmentManagement\Database\Seeders\DepartmentSeeder;
use Modules\DepartmentManagement\Models\Department;
use Modules\DepartmentManagement\Models\Room;
use Modules\DepartmentManagement\Models\Service;
use Modules\PatientManagement\Models\Patient;
use Modules\DoctorManagement\Models\Doctor;

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
        ]);
    }
}
