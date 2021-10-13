<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramUpdateRequest extends FormRequest
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
                'icon' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',
                'name_ar' => 'required',
                'name_en' => 'required',
                'short_description_ar' => 'required',
                'short_description_en' => 'required',
                'hours' => 'required|numeric',
                'work_plan' => 'sometimes|nullable|max:1024',
                'date' => 'required',
                'price' => 'required|numeric',
                'discount' => 'sometimes|nullable|numeric',
                'start_at' => 'required',
                'end_at' => 'required',
            ];
        } else {
            return [
                'icon' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',
                'name_ar' => 'required',
                'short_description_ar' => 'required',
                'hours' => 'required|numeric',
                'work_plan' => 'sometimes|nullable',
                'date' => 'required',
                'price' => 'required|numeric',
                'discount' => 'sometimes|nullable|numeric',
                'start_at' => 'required',
                'end_at' => 'required',
            ];
        }


    }

    public function messages()
    {
        return [
            'required' => trans('programs.required'),
            'in' => trans('programs.in'),
            'image' => trans('programs.image'),
            'mimes' => trans('programs.mimes'),
            'max' => trans('programs.image_max'),
            'photo.required' => trans('programs.photo_required'),
            'numeric' => trans('programs.numeric'),

        ];
    }
}
