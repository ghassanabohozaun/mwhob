<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class CourseTrashedResource extends JsonResource
{
    public function toArray($request)
    {
        $options = view('admin.courses.parts.trashed_options', ['instance' => $this])->render();
        $image = view('admin.courses.parts.image', ['instance' => $this])->render();
        $categoryID = view('admin.courses.parts.categoryID', ['instance' => $this->category])->render();
        $teacherID = view('admin.courses.parts.teacherID', ['instance' => $this->teacher])->render();
        $zoomLink = view('admin.courses.parts.zoomLink', ['instance' => $this])->render();
        $enrolledCount = view('admin.courses.parts.enrolledCount', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'course_image' => $image,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'hours' => $this->hours,
            'cost' => $this->cost,
            'discount' => $this->discount,
            'enrolled_count' => $enrolledCount,
            'category_id' =>$categoryID,
            'teacher_id' => $teacherID,
            'zoom_link' => $zoomLink,
            'actions' => $options
        ];
    }
}
