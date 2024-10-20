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

       
            'operation_name' => 'nullable|integer|string|max:255',
            'patient_id'     => 'nullable|integer|exists:patients,id',
            'doctor_id'      => 'nullable|integer|exists:doctors,id',
            'room_id'        => 'nullable|integer|exists:rooms,id',
            'duration'       => 'nullable|integer|min:1',
            'schedule_date'  => 'nullable|date|after_or_equal:today',
            'doctor_ids'   => 'nullable|array',
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
