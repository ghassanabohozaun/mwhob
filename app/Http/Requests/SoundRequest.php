<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SoundRequest extends FormRequest
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
                    'sound_image' =>  'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'mawhobs'=> 'required',
                    'sound_file' => 'required|mimes:mp3|max:10024',
                ];
            }else{
                return [
                    'sound_imagesound_image' =>  'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'mawhobs'=> 'required',
                    'sound_filesound_file' => 'required|mimes:mp3|max:10024',
                ];
            }
    }

    public function messages()
    {
        return [
            'required' => trans('sounds.required'),
            'in' => trans('sounds.in'),
            'image' => trans('sounds.image'),
            'sound_file.mimes' => trans('sounds.sound_mimes'),
            'sound_image.mimes' => trans('sounds.photo_mimes'),
            'sound_file.max' => trans('sounds.sound_max'),
            'sound_image.max' => trans('sounds.photo_max'),
            'photo.required' => trans('sounds.photo_required'),
            'numeric' => trans('sounds.numeric'),

        ];
    }
}
