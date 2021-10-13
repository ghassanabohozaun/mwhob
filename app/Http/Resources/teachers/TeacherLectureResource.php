<?php

namespace App\Http\Resources\teachers;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class TeacherLectureResource extends JsonResource
{
    public function toArray($request)
    {
        $options = view('teacher.courses.lectures.parts.options', ['instance' => $this])->render();
        $status = view('teacher.courses.lectures.parts.status', ['instance' => $this])->render();
        $lecture_cancel = view('teacher.courses.lectures.parts.lecture-cancel', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'lecture_date' => $this->lecture_date,
            'lecture_from' => $this->lecture_from,
            'lecture_to' => $this->lecture_to,
            'status' => $status,
            'lecture_cancel' => $lecture_cancel,
            'actions' => $options
        ];
    }
}
