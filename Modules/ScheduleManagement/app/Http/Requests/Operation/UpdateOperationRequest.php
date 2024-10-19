<?php

namespace Modules\ScheduleManagement\Http\Requests\Operation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOperationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'operation_name' => 'nullable|string|max:255',
            'patient_id'     => 'nullable|exists:patients,id',
            'doctor_id'      => 'nullable|exists:doctors,id',
            'room_id'        => 'nullable|exists:rooms,id',
            'team'           => 'nullable|array',
            'team.*'         => 'nullable|exists:doctors,id', // Ensure each doctor in the team exists
            'duration'       => 'nullable|integer|min:1',
            'schedule_date'  => 'nullable|date',
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
