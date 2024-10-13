<?php

namespace Modules\DepartmentManagement\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'room_number'   => 'nullable|numeric|max:255|unique:rooms',
            'status'        => 'nullable|string|in:occupied,vacant,Under Maintenance',
            'type'          => 'nullable|string|in:general,ICU,surgical',
            'beds_number'   => 'nullable|integer|min:1|max:7',
            'department_id' => 'nullable|exists:departments,id',
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
