<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WhyChooseUsRequest extends FormRequest
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
            'why_choose_us_ar' => 'required',
            'why_choose_us_en' => 'required',
            'reason_1' => 'required',
            'reason_2' => 'required',
            'reason_3' => 'required',
            'reason_4' => 'required',
            'reason_5' => 'required',
            'reason_6' => 'required',
            'reason_7' => 'required',
            'reason_en_1' => 'required',
            'reason_en_2' => 'required',
            'reason_en_3' => 'required',
            'reason_en_4' => 'required',
            'reason_en_5' => 'required',
            'reason_en_6' => 'required',
            'reason_en_7' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('landing.required'),
        ];
    }
}
