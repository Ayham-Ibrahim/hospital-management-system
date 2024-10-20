<?php

namespace Modules\ScheduleManagement\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\DoctorManagement\Transformers\DoctorResource;

class OperationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'operation_name' => $this->operation_name,
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'room_id' => $this->room_id, //? $this->room_number : null, // Assuming 'number' is the field for room number,
            'team' => $this->team,
            'duration' => $this->duration,
            'schedule_date' => $this->schedule_date,
            'patient' => [
                'id' => $this->patient->id,
                'name' => $this->patient->name,
            ],
            'doctor' => [
                'id' => $this->doctor->id,
                'name' => $this->doctor->name,
            ],
            'room' => [
                'id' => $this->room->id,
                'name' => $this->room->room_number,
            ],
           'team' => $this->doctors->map(function ($doctor){
                return [
                    'id' => $doctor->id,
                    'name' => $doctor->name,
                ];
           }),
        ];
    }
}
