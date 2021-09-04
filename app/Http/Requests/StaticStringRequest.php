<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaticStringRequest extends FormRequest
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
                'talents_description_ar' => 'required',
                'talents_description_en' => 'required',
                'soundtrack_description_ar' => 'required',
                'soundtrack_description_en' => 'required',
                'videos_description_ar' => 'required',
                'videos_description_en' => 'required',
                'success_stories_description_ar' => 'required',
                'success_stories_description_en' => 'required',
                'success_story_categories_description_ar' => 'required',
                'success_story_categories_description_en' => 'required',
                'success_story_description_ar' => 'required',
                'success_story_description_en' => 'required',
                'success_story_person_description_ar' => 'required',
                'success_story_person_description_en' => 'required',
                'programs_description_ar' => 'required',
                'programs_description_en' => 'required',
                'courses_description_ar' => 'required',
                'courses_description_en' => 'required',
                'contests_description_ar' => 'required',
                'contests_description_en' => 'required',
                'summer_camps_description_ar' => 'required',
                'summer_camps_description_en' => 'required',
                'magazine_description_ar' => 'required',
                'magazine_description_en' => 'required',
                'latest_winners_description_ar' => 'required',
                'latest_winners_description_en' => 'required',


            ];
    }

    public function messages()
    {
        return [
            'required' => trans('landing.required'),
        ];
    }
}
