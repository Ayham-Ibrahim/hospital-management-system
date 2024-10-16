<?php

namespace Modules\PatientManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\PatientManagement\Models\Patient::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'medical_description' => $this->faker->paragraph,
            'address' => $this->faker->address,
            'mobile_number' => $this->faker->phoneNumber,
        ];
    }
}
