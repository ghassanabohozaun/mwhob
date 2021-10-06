<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexPageRequest extends FormRequest
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
                'mawhobs_description_ar' => 'required',
                'mawhobs_description_en' => 'required',
                'courses_description_ar' => 'required',
                'courses_description_en' => 'required',
                'best_mawhobs_description_ar' => 'required',
                'best_mawhobs_description_en' => 'required',

                'best_app_image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',
                'best_app_description_ar' => 'required',
                'best_app_description_en' => 'required',

                'best_courses_description_ar' => 'required',
                'best_courses_description_en' => 'required',
                'about_team_image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',
                'about_team_ar' => 'required',
                'about_team_en' => 'required',
                'our_mission_ar' => 'required',
                'our_mission_en' => 'required',
                'best_mawhobs' => 'required',


            ];
    }

    public function messages()
    {
        return [
            'required' => trans('landing.required'),
        ];
    }
}
