<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChooseContestMawhobRequest extends FormRequest
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
                'mawhob_winner_description_ar' => 'required',
                'mawhob_winner_description_en' => 'required',
            ];
        } else {
            return [
                'mawhob_winner_description_ar' => 'required',
                'mawhob_winner_description_en' => 'required',
            ];
        }


    }

    public function messages()
    {
        return [
            'required' => trans('contests.required'),
            'in' => trans('contests.in'),
            'image' => trans('contests.image'),
            'mimes' => trans('contests.mimes'),
            'max' => trans('contests.image_max'),
            'photo.required' => trans('contests.photo_required'),
        ];
    }
}
