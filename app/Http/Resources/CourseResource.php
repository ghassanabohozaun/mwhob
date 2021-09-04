<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        $options = view('admin.courses.parts.options', ['instance' => $this])->render();
        $image = view('admin.courses.parts.image', ['instance' => $this])->render();
        $status = view('admin.courses.parts.status', ['instance' => $this])->render();
        $active = view('admin.courses.parts.active', ['instance' => $this])->render();
        $categoryID = view('admin.courses.parts.categoryID', ['instance' => $this->category])->render();
        $teacherID = view('admin.courses.parts.teacherID', ['instance' => $this->teacher])->render();
        $zoomLink = view('admin.courses.parts.zoomLink', ['instance' => $this])->render();



        return [
            'id' => $this->id,
            'course_image' => $image,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'hours' => $this->hours,
            'cost' => $this->cost,
            'discount' => $this->discount,
            'category_id' => $categoryID,
            'teacher_id' =>$teacherID,
            'zoom_link' => $zoomLink,
            'status' => $status,
            'active' => $active,
            'actions' => $options
        ];
    }
}
