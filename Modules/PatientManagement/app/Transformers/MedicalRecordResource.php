<?php

namespace Modules\PatientManagement\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\DoctorManagement\Transformers\DoctorResource;
use Modules\PatientManagement\Transformers\PatientResource;
use Modules\DepartmentManagement\Transformers\Room\RoomResource;

class MedicalRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'blood_type'     => $this->blood_type,
            'admission_date' => $this->admission_date,
            'discharge_date' => $this->discharge_date,
            'medicines'      => $this->medicines,
            'details'        => $this->details,
            'patient'        => [
                'id' => $this->doctor->id,
                'name' => $this->doctor->name,
            ], 
            'doctor'         => [
                'id' => $this->doctor->id,
                'name' => $this->doctor->name,
            ],
            'room'           => [
                'id' => $this->room->id,
                'name' => $this->room->room_number,
            ],  
        ];
    }
}
