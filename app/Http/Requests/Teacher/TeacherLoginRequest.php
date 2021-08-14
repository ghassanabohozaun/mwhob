<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class TeacherLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'teacher_email'=>'required|email',
            'password'=>'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'teacher_email.required'=>trans('login.email_required'),
            'teacher_email.email'=>trans('login.email_email'),
            'password.required'=>trans('login.password_required'),
            'password.min'=>trans('login.password_min'),
        ];
    }
}
