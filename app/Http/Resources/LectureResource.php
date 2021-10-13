<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class LectureResource extends JsonResource
{
    public function toArray($request)
    {
        $options = view('admin.courses.lectures.parts.options', ['instance' => $this])->render();
        $status = view('admin.courses.lectures.parts.status', ['instance' => $this])->render();
        $lecture_cancel = view('admin.courses.lectures.parts.lecture-cancel', ['instance' => $this])->render();

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
