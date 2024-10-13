<?php

namespace Database\Factories\Modules\DepartmentManagement\Models;

use Modules\DepartmentManagement\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\DepartmentManagement\Models\Department;


class ServiceFactory extends Factory
{

    protected $model = Service::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'department_id' => Department::factory()
        ];
    }
}
