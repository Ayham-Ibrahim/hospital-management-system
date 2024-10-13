<?php

namespace Modules\DepartmentManagement\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' =>['required','string','min:2','max:20'],
            'description' =>['required','string','min:2','max:255'],
            'phone_number' =>['required','numeric','regex:/[0-9]{7}/'],
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
