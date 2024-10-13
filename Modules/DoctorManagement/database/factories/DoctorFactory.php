<?php

namespace Modules\DoctorManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\DepartmentManagement\Models\Department;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\DoctorManagement\Models\Doctor::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // 'name' => $this->faker->name(),
            // 'speciality' => $this->faker->randomElement(['Cardiology', 'Neurology', 'Oncology', 'Pediatrics']), 
            // 'image' => $this->faker->image('/app/public/doctors', 640, 480, null, true), 
            // 'department_id' => Department::factory(), 
            // 'mobile_number' => $this->faker->phoneNumber(),
            // 'job_date' => $this->faker->date(),
            // 'address' => $this->faker->address(),
            // 'salary' => $this->faker->randomFloat(2, 5000, 20000),
        ];
    }
}

