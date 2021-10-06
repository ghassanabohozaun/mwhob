<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationPolicyRequest extends FormRequest
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
                'policy_title_ar' => 'required',
                'policy_title_en' => 'required',
                'policy_details_ar' => 'required',
                'policy_details_en' => 'required',
            ];
    }

    public function messages()
    {
        return [
            'required' => trans('landing.required'),
        ];
    }
}
