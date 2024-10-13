<?php

namespace Modules\DepartmentManagement\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'          =>['nullable','string','min:2','max:20'],
            'description'  =>['nullable','string','min:2','max:255'],
            'department_id' =>['nullable','exists:departments,id'],
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
