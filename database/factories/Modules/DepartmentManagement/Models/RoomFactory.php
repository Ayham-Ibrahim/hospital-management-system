<?php

namespace Database\Factories\Modules\DepartmentManagement\Models;

use Modules\DepartmentManagement\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\DepartmentManagement\Models\Department;


class RoomFactory extends Factory
{
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_number' => $this->faker->unique()->numberBetween(1, 255),
            'status' => $this->faker->randomElement(['occupied', 'vacant', 'Under Maintenance']),
            'type' => $this->faker->randomElement(['general', 'ICU', 'surgical']),
            'beds_number' => $this->faker->numberBetween(1, 7),
            'department_id' => Department::factory(), 
        ];
    }
}
