<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'mawhob_full_name' => 'required',
            'mawhob_full_name_en' => 'required',
            'mawhob_mobile_no' => 'required',
            'mawhob_whatsapp_no' => 'required',
            'mawhob_birthday' => 'required',
            'mowhob_gender' => 'required|in:male,female',
            'category_id' => 'required',
            'portfolio' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'mawhob_email' => 'required|email',
            'country' => 'required',
            'other_talents' => 'sometimes|nullable',

        ];
    }

    public function messages()
    {
        return [
            'required' => trans('mowhob.required'),
            'in' => trans('mowhob.in'),
            'photo.image' => trans('mowhob.image'),
            'photo.required' => trans('mowhob.photo_required'),
            'photo.mimes' => trans('mowhob.mimes'),
            'photo.max' => trans('mowhob.image_max'),
            'portfolio.max' => trans('mowhob.portfolio_max'),
            'mawhob_email.email'=>trans('mowhob.email_email'),
            'mawhob_birthday.before'=>trans('mowhob.mwhob_birthday'),
            'portfolio.url'=>trans('mowhob.url'),
        ];
    }
}
