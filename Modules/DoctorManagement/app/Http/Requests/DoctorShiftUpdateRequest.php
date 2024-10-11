<?php

namespace Modules\DoctorManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorShiftUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'doctor_id' => 'nullable|exists:doctors,id',
            'date' => 'nullable|date',
            'start_shift' => 'nullable|date_format:H:i',
            'end_shift' => 'nullable|date_format:H:i',
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
