<?php

namespace Modules\PatientManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\DepartmentManagement\Models\Room;
use Modules\PatientManagement\Models\MedicalRecord;

class MedicalRecordFactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = MedicalRecord::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // 'patient_id' => Patient::factory(),
            // 'doctor_id' => $this->faker->numberBetween(1, 6),
            // 'room_id' => Room::factory(),
            // 'blood_type' => $this->faker->bloodType,
            // 'admission_date' => now()->subDays(rand(1, 30)),
            // 'discharge_date' => now()->addDays(rand(1, 30)),
            // 'medicines' => [],
            // 'details' => $this->faker->word,
            // 'type' => $this->faker->word,
        ];
    }
}

