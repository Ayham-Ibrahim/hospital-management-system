<?php

namespace Modules\PatientManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PatientManagement\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::factory()->count(10)->create();
    }
}
