<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mawhob_mobile_no'=>'required',
            'password'=>'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'mawhob_mobile_no.required'=>trans('site.mawhob_mobile_no_requird'),
            'password.required'=>trans('site.password_required'),
            'password.min'=>trans('site.min_length'),
        ];
    }
}
