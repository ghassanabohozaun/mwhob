<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class TeacherCourseUpdateRequest extends FormRequest
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
                'course_image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',
                'title_ar' => 'required',
                'title_en' => 'required',
                'description_ar' => 'required',
                'description_en' => 'required',
                'hours' => 'required|numeric',
                'cost' => 'required|numeric',
                'start_at' => 'required',
                'end_at' => 'required',
                'category_id' => 'required|numeric',
                'zoom_link' => 'required',
            ];
        } else {
            return [
                'course_image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',
                'title_ar' => 'required',
                'description_ar' => 'required',
                'hours' => 'required|numeric',
                'cost' => 'required|numeric',
                'start_at' => 'required',
                'end_at' => 'required',
                'category_id' => 'required|numeric',
                'zoom_link' => 'required',
            ];
        }


    }

    public function messages()
    {
        return [
            'required' => trans('courses.required'),
            'in' => trans('courses.in'),
            'image' => trans('courses.image'),
            'mimes' => trans('courses.mimes'),
            'max' => trans('courses.image_max'),
            'photo.required' => trans('courses.photo_required'),
            'numeric' => trans('courses.numeric'),

        ];
    }
}
