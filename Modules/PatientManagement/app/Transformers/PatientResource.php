<?php

namespace Modules\PatientManagement\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'medical_description' => $this->medical_description,
            'address' => $this->address,
            'mobile_number' => $this->mobile_number,
            'services' => ServiceResource::collection($this->whenLoaded('services')),
        ];
    }
}
