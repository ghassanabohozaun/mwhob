<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateRequest extends FormRequest
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
            'teacher_photo' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',
            'teacher_full_name' => 'required',
            'teacher_bio' => 'required',
            'password' => 'sometimes|nullable|min:6',
            'teacher_mobile_no' => 'required',
            'teacher_whatsapp_no' => 'required',
            'teacher_qualification' => 'required',
            'teacher_cv' => 'sometimes|nullable|max:1024',
            'teacher_photos_and_videos_link' => 'required',
            'teacher_gender' => 'required|in:male,female',
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('teachers.required'),
            'in' => trans('teachers.in'),
            'teacher_photo.image' => trans('teachers.image'),
            'teacher_photo.required' => trans('teachers.image_required'),
            'teacher_photo.mimes' => trans('teachers.mimes'),
            'teacher_photo.max' => trans('teachers.image_max'),
            'teacher_email.unique' => trans('teachers.email_unique'),
            'teacher_email.email' => trans('teachers.email_email'),
            'password.min' => trans('teachers.min'),
        ];
    }
}
