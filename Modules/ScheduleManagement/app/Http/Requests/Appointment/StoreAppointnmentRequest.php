<?php

namespace Modules\ScheduleManagement\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointnmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['required','integer','exists:patients,id'],
            'doctor_id' => ['required','integer','exists:doctors,id'],
            'appointment_date' => ['required','date','after_or_equal:today'],
            'status' => ['required','string','in:scheduled,completed,canceled']
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
