<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SumerCampUpdateRequest extends FormRequest
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
                'summer_camp_image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',
                'name_ar' => 'required',
                'name_en' => 'required',
                'short_description_ar' => 'required',
                'short_description_en' => 'required',
            ];
        } else {
            return [
                'summer_camp_image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',
                'name_ar' => 'required',
                'short_description_ar' => 'required',
            ];
        }


    }

    public function messages()
    {
        return [
            'required' => trans('summerCamps.required'),
            'in' => trans('summerCamps.in'),
            'image' => trans('summerCamps.image'),
            'mimes' => trans('summerCamps.mimes'),
            'max' => trans('summerCamps.image_max'),
            'photo.required' => trans('summerCamps.photo_required'),
        ];
    }
}
