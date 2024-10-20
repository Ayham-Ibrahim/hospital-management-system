<?php

namespace Modules\DoctorManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'image' => 'required|image',
            'department_id' => 'required|exists:departments,id',
            'mobile_number' => 'required|string|max:20',
            'job_date' => 'required|date',
            'address' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'days' => 'required|array', // Days can be an array
            'days.*' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', // Validate each day
            'start_work' => 'required|date_format:H:i',
            'end_work' => 'required|date_format:H:i',
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
