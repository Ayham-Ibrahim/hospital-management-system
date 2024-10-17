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
            'patient_id'     => new PatientResource($this->patient),
            'blood_type'     => $this->blood_type,
            'admission_date' => $this->admission_date,
            'discharge_date' => $this->discharge_date,
            'medicines'      => $this->medicines,
            'details'        => $this->details,
            'doctor_id'      => new DoctorResource($this->doctor),
            'room_id'        => new RoomResource($this->room),
        ];
    }
}
