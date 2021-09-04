<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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

        if ($this->input('video_class') == 'youtube') {
            if (setting()->site_lang_en == 'on') {
                return [
                    'video_image' =>  'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'video_class' => 'required',
                    'youtube_link'=> 'required',
                    'mawhobs'=> 'required',
                ];
            }else{
                return [
                    'video_image' =>  'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'video_class' => 'required',
                    'youtube_link'=> 'required',
                    'mawhobs'=> 'required',
                ];
            }

        } else  if ($this->input('video_class') == 'vimeo') {
            if (setting()->site_lang_en == 'on') {
                return [
                    'video_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'video_class' => 'required',
                    'vimeo_link' => 'required',
                    'mawhobs'=> 'required',
                ];
            }else{
                return [
                    'video_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'video_class' => 'required',
                    'vimeo_link' => 'required',
                    'mawhobs'=> 'required',
                ];
            }
        } else  if ($this->input('video_class') == 'uploaded_video') {
            if (setting()->site_lang_en == 'on') {
                return [
                    'video_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'video_class' => 'required',
                    'upload_video_link' => 'required',
                    'mawhobs'=> 'required',
                ];
            }else{
                return [
                    'video_image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
                    'name_ar' => 'required',
                    'date' => 'required',
                    'length' => 'required|numeric',
                    'video_class' => 'required',
                    'upload_video_link' => 'required',
                    'mawhobs'=> 'required',
                ];
            }
        }
    }

    public function messages()
    {
        return [
            'required' => trans('videos.required'),
            'in' => trans('videos.in'),
            'image' => trans('videos.image'),
            'mimes' => trans('videos.mimes'),
            'max' => trans('videos.image_max'),
            'photo.required' => trans('videos.photo_required'),
            'numeric' => trans('videos.numeric'),
        ];
    }
}
