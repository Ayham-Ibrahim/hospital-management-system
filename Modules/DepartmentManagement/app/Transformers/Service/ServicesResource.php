<?php

namespace Modules\DepartmentManagement\Transformers\Service;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\DepartmentManagement\Transformers\Department\DepartmentResource;

class ServicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'  => $this->description,
            'department' => new DepartmentResource($this->department),
        ];
    }
}
