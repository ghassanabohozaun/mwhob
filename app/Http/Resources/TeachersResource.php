<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class TeachersResource extends JsonResource
{
    public function toArray($request)
    {
        $options = view('admin.teachers.parts.options', ['instance' => $this])->render();
        $freeze = view('admin.teachers.parts.freeze', ['instance' => $this])->render();
        $photo = view('admin.teachers.parts.photo', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'teacher_photo' => $photo,
            'teacher_full_name' => $this->teacher_full_name,
            'teacher_full_name_en' => $this->teacher_full_name_en,
            'teacher_email' => $this->teacher_email,
            'teacher_mobile_no' => $this->teacher_mobile_no,
            'teacher_whatsapp_no' => $this->teacher_whatsapp_no,
            'teacher_qualification' =>  $this->teacher_qualification,
            'teacher_freeze' => $freeze,
            'actions' => $options
        ];
    }
}
