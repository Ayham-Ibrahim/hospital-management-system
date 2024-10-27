<?php

namespace Modules\AuthManagement\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable','string','unique:roles,name','min:2'],
            'permissions'   => ['nullable','array'],
            'permissions.*' => ['integer','exists:permissions,id']
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
