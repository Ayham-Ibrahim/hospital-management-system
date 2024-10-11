<?php

namespace Modules\DoctorManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'speciality' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|required|image|mimes:jpg,jpeg,png|max:2048',
            'department_id' => 'sometimes|required|exists:departments,id',
            'mobile_number' => 'sometimes|required|string|max:20',
            'job_date' => 'sometimes|required|date',
            'address' => 'sometimes|required|string|max:255',
            'salary' => 'sometimes|required|numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
