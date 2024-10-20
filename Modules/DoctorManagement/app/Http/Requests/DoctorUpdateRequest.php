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
            'name' => 'nullable|string|max:255',
            'speciality' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'department_id' => 'nullable|exists:departments,id',
            'mobile_number' => 'nullable|string|max:20',
            'job_date' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric',
            'days' => 'nullable|array',
            'days.*' => 'nullable|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_work' => 'nullable|date_format:H:i',
            'end_work' => 'nullable|date_format:H:i',
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
