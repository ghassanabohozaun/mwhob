<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryCategoryRequest extends FormRequest
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
                'category_icon' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                'name_ar' => 'required',
                'name_en' => 'required',
                'description_ar' => 'required',
                'description_en' => 'required',
            ];
        } else {
            return [
                'category_icon' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                'name_ar' => 'required',
                'description_ar' => 'required',
            ];
        }


    }

    public function messages()
    {
        return [
            'required' => trans('categories.required'),
            'in' => trans('categories.in'),
            'image' => trans('categories.image'),
            'mimes' => trans('categories.mimes'),
            'max' => trans('categories.image_max'),
            'photo.required' => trans('categories.photo_required'),
        ];
    }
}
