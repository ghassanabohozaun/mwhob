<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryRequest extends FormRequest
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
                'story_icon' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                'story_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                'about_mawhob_ar' => 'required',
                'about_mawhob_en' => 'required',
                'mawhob_id' => 'required',
                'story_category_id' => 'required',
            ];
        } else {
            return [
                'story_icon' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                'story_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                'about_mawhob_ar' => 'required',
                'mawhob_id' => 'required',
                'story_category_id' => 'required',
            ];
        }


    }

    public function messages()
    {
        return [
            'required' => trans('stories.required'),
            'in' => trans('stories.in'),
            'image' => trans('stories.image'),
            'mimes' => trans('stories.mimes'),
            'max' => trans('stories.image_max'),
            'photo.required' => trans('stories.photo_required'),
        ];
    }
}
