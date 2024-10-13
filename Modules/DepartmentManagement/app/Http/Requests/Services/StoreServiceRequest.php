<?php

namespace Modules\DepartmentManagement\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'          =>['required','string','min:2','max:20'],
            'description'  =>['required','string','min:2','max:255'],
            'department_id' =>['required','exists:departments,id'],
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
