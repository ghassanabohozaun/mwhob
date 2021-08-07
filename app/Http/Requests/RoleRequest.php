<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_name_ar' => 'required',
            'role_name_en' => 'required',
            'permissions' => 'required|array|min:1',
        ];
    }

    public function messages()
    {
        return [
            'role_name_ar.required' => trans('roles.role_name_ar_required'),
            'role_name_en.required' => trans('roles.role_name_en_required'),
            'permissions.required' => trans('roles.permission_required'),
            'min' => trans('roles.min')
        ];
    }
}
