<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContestRequest extends FormRequest
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
        if (setting()->site_lang_en == 'on') {
            return [
                'contest_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                'name_ar' => 'required',
                'name_en' => 'required',
                'short_description_ar' => 'required',
                'short_description_en' => 'required',
                'end_date' => 'required',
                'prize' => 'required',
            ];
        } else {
            return [
                'contest_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                'name_ar' => 'required',
                'short_description_ar' => 'required',
                'end_date' => 'required',
                'prize' => 'required',
            ];
        }


    }

    public function messages()
    {
        return [
            'required' => trans('contests.required'),
            'in' => trans('contests.in'),
            'image' => trans('contests.image'),
            'mimes' => trans('contests.mimes'),
            'max' => trans('contests.image_max'),
            'photo.required' => trans('contests.photo_required'),
        ];
    }
}
