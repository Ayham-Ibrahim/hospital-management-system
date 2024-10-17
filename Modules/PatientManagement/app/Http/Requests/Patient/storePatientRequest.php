<?php

namespace Modules\PatientManagement\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'medical_description' => 'required|string',
            'address' => 'required|string',
            'mobile_number' => 'required|string',
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
