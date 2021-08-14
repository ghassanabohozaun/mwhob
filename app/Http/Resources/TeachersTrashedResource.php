<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class TeachersTrashedResource extends JsonResource
{
    public function toArray($request)
    {
        $options = view('admin.teachers.parts.trashed_options', ['instance' => $this])->render();
        $photo = view('admin.teachers.parts.photo', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'teacher_photo' => $photo,
            'teacher_full_name' => $this->teacher_full_name,
            'teacher_email' => $this->teacher_email,
            'teacher_mobile_no' => $this->teacher_mobile_no,
            'teacher_whatsapp_no' => $this->teacher_whatsapp_no,
            'teacher_qualification' =>  $this->teacher_qualification,
            'actions' => $options
        ];
    }
}
