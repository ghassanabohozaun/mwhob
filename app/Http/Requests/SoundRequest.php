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

        if ($this->input('sound_class') == 'youtube') {
            if (setting()->site_lang_en == 'on') {
                return [
                    'sound_image' =>  'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'sound_class' => 'required',
                    'youtube_link'=> 'required',
                    'mawhobs'=> 'required',
                ];
            }else{
                return [
                    'sound_image' =>  'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'sound_class' => 'required',
                    'youtube_link'=> 'required',
                    'mawhobs'=> 'required',
                ];
            }

        } else  if ($this->input('sound_class') == 'vimeo') {
            if (setting()->site_lang_en == 'on') {
                return [
                    'sound_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'sound_class' => 'required',
                    'vimeo_link' => 'required',
                    'mawhobs'=> 'required',
                ];
            }else{
                return [
                    'sound_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'sound_class' => 'required',
                    'vimeo_link' => 'required',
                    'mawhobs'=> 'required',
                ];
            }
        } else  if ($this->input('sound_class') == 'uploaded_sound') {
            if (setting()->site_lang_en == 'on') {
                return [
                    'sound_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'sound_class' => 'required',
                    'upload_sound_link' => 'required',
                    'mawhobs'=> 'required',
                ];
            }else{
                return [
                    'sound_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'sound_class' => 'required',
                    'upload_sound_link' => 'required',
                    'mawhobs'=> 'required',
                ];
            }
        }
    }

    public function messages()
    {
        return [
            'required' => trans('sounds.required'),
            'in' => trans('sounds.in'),
            'image' => trans('sounds.image'),
            'mimes' => trans('sounds.mimes'),
            'max' => trans('sounds.image_max'),
            'photo.required' => trans('sounds.photo_required'),
            'numeric' => trans('sounds.numeric'),

        ];
    }
}
