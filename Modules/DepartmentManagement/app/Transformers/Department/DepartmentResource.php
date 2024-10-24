<?php

namespace Modules\DepartmentManagement\Transformers\Department;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use  Modules\DepartmentManagement\Transformers\Room\RoomResource;
use  Modules\DoctorManagement\Transformers\DoctorResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'phone_number' => $this->phone_number,
            'room_count' => $this->room_count,
            'doctor_count' => $this->doctor_count,
            'empty_room_count' => $this->empty_room_count,
            'rooms' => RoomResource::collection($this->whenLoaded('rooms')),
            'doctors' => DoctorResource::collection($this->whenLoaded('doctors')),
        ];
    }
}
