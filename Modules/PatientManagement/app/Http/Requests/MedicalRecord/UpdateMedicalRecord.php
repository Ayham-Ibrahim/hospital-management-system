<?php

namespace Modules\PatientManagement\Http\Requests\MedicalRecord;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicalRecord extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'patient_id'     => ['nullable','exists:patients,id','numeric'],
            'doctor_id'      => ['nullable','exists:doctors,id','numeric'],
            'room_id'        => ['nullable','exists:rooms,id','numeric'],
            'blood_type'     => ['nullable','string','max:10'],
            'admission_date' => ['nullable','date'],
            'discharge_date' => ['nullable','date'],
            'medicines'      => ['array'],
            'medicine.*'     => ['nullable','string','min:2','max:20'],
            'details'        => ['nullable','string','min:10','max:1000'],
            // 'type'           => ['nullable','string','min:10','max:1000'],
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
