<?php

namespace Modules\ScheduleManagement\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointnmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['nullable','integer','exists:patients,id'],
            'doctor_id' => ['nullable','integer','exists:doctors,id'],
            'appointment_date' => ['nullable','date','after_or_equal:today'],
            'status' => ['nullable','string','in:scheduled,completed,canceled']
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
