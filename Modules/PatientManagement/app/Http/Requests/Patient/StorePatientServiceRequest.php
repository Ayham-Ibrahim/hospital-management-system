<?php

namespace Modules\PatientManagement\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'service_ids' => 'required|array',
            'service_ids.*' => 'integer|exists:services,id',
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
