<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class contestRegistrationTermsRequest extends FormRequest
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
            'contest_id' => 'sometimes|nullable',
            'mawhob_id' => 'sometimes|nullable',
            'link' => 'required_without:file',
            'file' => 'required_without:link',
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('mowhob.required'),
            'portfolio.url'=>trans('mowhob.url'),
        ];
    }
}
