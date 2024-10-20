<?php

namespace Modules\DepartmentManagement\Transformers\Room;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\DepartmentManagement\Transformers\Department\DepartmentResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'room_number'   => $this->room_number,
            'status'        => $this->status,
            'type'          => $this->type,
            'beds_number'   => $this->beds_number,
            'department'    => [
                'id' => $this->department->id,
                'name' => $this->department->name,
            ],
            'patients' => $this->medicalRecords->map(function ($record) {
                return [
                    'patient_id' => $record->patient->id,
                    'patient_name' => $record->patient->name,
                ];
            }),
        ];
    }
}
