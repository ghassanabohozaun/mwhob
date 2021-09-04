<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureRequest extends FormRequest
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


    public function rules()
    {
        return [
            'lecture_date' => 'required',
            'lecture_from' => 'required|date_format:H:i',
            'lecture_to' => 'required|date_format:H:i|after:lecture_from',

        ];
    }

    public function messages()
    {
        return [
            'required' => trans('courses.required'),
            'lecture_from.date_format' => trans('courses.the_lecture_start_time_does_not_match_the_format_H_i'),
            'lecture_to.date_format' => trans('courses.the_lecture_end_time_does_not_match_the_format_H_i'),
            'lecture_to.after' => trans('courses.the_lecture_end_time_must_be_date_after_lecture_start_time'),
        ];
    }
}
