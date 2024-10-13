<?php

namespace Database\Factories\Modules\DepartmentManagement\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\DepartmentManagement\Models\Department;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

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
            'phone_number' => $this->faker->regexify('[0-9]{7}'),
        ];
    }
}
