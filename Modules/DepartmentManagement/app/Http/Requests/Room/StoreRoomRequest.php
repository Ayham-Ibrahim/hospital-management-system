<?php

namespace Modules\DepartmentManagement\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'room_number' => 'required|numeric|max:255|unique:rooms',
            'status' => 'required|string|in:occupied,vacant,Under Maintenance',
            'type' => 'required|string|in:general,ICU,surgical',
            'beds_number' => 'required|integer|min:1|max:7',
            'department_id' => 'required|exists:departments,id',
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
