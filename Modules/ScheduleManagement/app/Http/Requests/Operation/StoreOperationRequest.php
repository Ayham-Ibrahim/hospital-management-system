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
            'patient_id' => 'required|integer|exists:patients,id',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'room_id' => 'required|integer|exists:rooms,id',
            'duration' => 'required|integer|min:1',
            'schedule_date' => 'required|date|after_or_equal:today',
            'doctor_ids'   => 'required|array',
            'doctor_ids.*' => 'exists:doctors,id', 

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
