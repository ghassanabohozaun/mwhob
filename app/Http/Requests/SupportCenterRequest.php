<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportCenterRequest extends FormRequest
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
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'title' => 'required',
            'message' => 'required',
            'captcha' => 'required|captcha'
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('supportCenter.required'),
            'customer_email.email' => trans('supportCenter.email_email'),
            'captcha'=>trans('supportCenter.captcha')
        ];
    }
}
