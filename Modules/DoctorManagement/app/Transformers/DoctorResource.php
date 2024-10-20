<?php

namespace Modules\DoctorManagement\Transformers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\DepartmentManagement\Transformers\Department\DepartmentResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'speciality'    => $this->speciality,
            'image'         => $this->image ? Storage::url($this->image) : null,  // Ensure the image is accessible
            'mobile_number' => $this->mobile_number,
            'job_date'      => $this->job_date,
            'address'       => $this->address,
            'salary'        => $this->salary,
            'days'          => $this->days,
            'start_work'    => $this->start_work,
            'end_work'      => $this->end_work,
            'department'    => new DepartmentResource($this->department),
        ];
    }
}
