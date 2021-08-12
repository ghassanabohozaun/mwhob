<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'required',
            'password'=>'sometimes|nullable|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>trans('login.name_requires'),
            'email.required'=>trans('login.email_required'),
            'email.email'=>trans('login.email_email'),
            'password.min'=>trans('login.password_min'),
        ];
    }
}
