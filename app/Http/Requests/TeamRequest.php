<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
                'team_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                'name_ar' => 'required',
                'name_en' => 'required',
                'position_ar' => 'required',
                'position_en' => 'required',
            ];
    }

    public function messages()
    {
        return [
            'required' => trans('landing.required'),
            'image' => trans('landing.image'),
            'mimes' => trans('landing.mimes'),
            'max' => trans('landing.image_max'),
            'photo.required' => trans('landing.photo_required'),
        ];
    }
}
