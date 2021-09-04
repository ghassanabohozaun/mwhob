<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutMawhobRequest extends FormRequest
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
                'title_ar' => 'required',
                'title_en' => 'required',
                'summary_ar' => 'required',
                'summary_en' => 'required',
                'details_ar' => 'required',
                'details_en' => 'required',
                'video' => 'sometimes|nullable',
            ];
    }

    public function messages()
    {
        return [
            'required' => trans('landing.required'),
        ];
    }
}
