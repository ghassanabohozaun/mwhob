<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class SummerCampsResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.summer-camps.parts.options', ['instance' => $this])->render();
        $image = view('admin.summer-camps.parts.image', ['instance' => $this])->render();
        $status = view('admin.summer-camps.parts.status', ['instance' => $this])->render();
        $enrolledCount = view('admin.summer-camps.parts.enrolled-count', ['instance' => $this])->render();
        $enableEnrolling = view('admin.summer-camps.parts.enable-enrolling', ['instance' => $this])->render();


        return [
            'id' => $this->id,
            'summer_camp_image' =>$image,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'short_description_ar' => $this->short_description_ar,
            'short_description_en' => $this->short_description_en,
            'cost' => $this->cost,
            'discount' => $this->discount,
            'year'=> $this->year,
            'enrolled_count' => $enrolledCount,
            'status' => $status,
            'enable_enrolling' => $enableEnrolling,
            'actions' => $options
        ];
    }
}
