<?php

namespace App\Http\Resources\teachers;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class TeacherCourseResource extends JsonResource
{
    public function toArray($request)
    {
        $options = view('teacher.courses.parts.options', ['instance' => $this])->render();
        $image = view('teacher.courses.parts.image', ['instance' => $this])->render();
        $active = view('teacher.courses.parts.active', ['instance' => $this])->render();
        $categoryID = view('teacher.courses.parts.categoryID', ['instance' => $this->category])->render();
        $zoomLink = view('teacher.courses.parts.zoomLink', ['instance' => $this])->render();



        return [
            'id' => $this->id,
            'course_image' => $image,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'hours' => $this->hours,
            'cost' => $this->cost,
            'discount' => $this->discount,
            'category_id' => $categoryID,
            'zoom_link' => $zoomLink,
            'active' => $active,
            'actions' => $options
        ];
    }
}
