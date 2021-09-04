<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryyCategoryUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (setting()->site_lang_en == 'on') {
            return [
                'category_icon' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',
                'name_ar' => 'required',
                'name_en' => 'required',
                'description_ar' => 'required',
                'description_en' => 'required',
            ];
        } else {
            return [
                'category_icon' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',
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
