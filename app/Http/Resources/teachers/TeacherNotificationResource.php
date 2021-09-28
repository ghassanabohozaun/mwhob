<?php

namespace App\Http\Resources\teachers;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class TeacherNotificationResource extends JsonResource
{
    public function toArray($request)
    {
        $options = view('teacher.notifications.parts.options', ['instance' => $this])->render();
        $date = view('teacher.notifications.parts.date', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'details_ar' => $this->details_ar,
            'details_en' => $this->details_en,
            'date' => $date,
            'actions' => $options
        ];
    }
}
