<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContestRenew extends FormRequest
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
            'end_date' => 'required',
            'prize' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('trainings.required')
        ];
    }
}
