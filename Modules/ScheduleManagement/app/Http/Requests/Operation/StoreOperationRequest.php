<?php

namespace Modules\ScheduleManagement\Http\Requests\Operation;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'operation_name' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'room_id' => 'required|exists:rooms,id',
            'team' => 'required|array',
            'team.*' => 'exists:doctors,id', // Ensure each doctor in the team exists
            'duration' => 'required|integer|min:1',
            'schedule_date' => 'required|date',
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
