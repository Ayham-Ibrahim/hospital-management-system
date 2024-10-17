<?php

namespace Modules\PatientManagement\Http\Requests\MedicalRecord;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalRecord extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'patient_id'     => ['required','exists:patients,id','numeric'],
            'doctor_id'      => ['required','exists:doctors,id','numeric'],
            'room_id'        => ['required','exists:rooms,id','numeric'],
            'blood_type'     => ['required','string','max:10'],
            'admission_date' => ['required','date'],
            'discharge_date' => ['required','date'],
            'medicines'      => ['array'],
            'medicine.*'     => ['string','min:2','max:20'],
            'details'        => ['required','string','min:10','max:1000'],
            // 'type'           => ['required','string','min:10','max:1000'],
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
