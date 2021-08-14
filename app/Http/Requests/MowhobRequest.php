<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MowhobRequest extends FormRequest
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
            'mawhob_full_name' => 'required',
            'mawhob_mobile_no' => 'required',
            'mawhob_whatsapp_no' => 'required',
            'mawhob_birthday' => 'required',
            'mowhob_gender' => 'required|in:male,female',
            'category_id' => 'required',
            'portfolio' => 'required',
            'photo' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:1024',

        ];
    }

    public function messages()
    {
        return [
            'required' => trans('mowhob.required'),
            'in' => trans('mowhob.in'),
            'photo.image' => trans('mowhob.image'),
            'photo.required' => trans('mowhob.photo_required'),
            'photo.mimes' => trans('mowhob.mimes'),
            'photo.max' => trans('mowhob.image_required'),
        ];
    }
}
