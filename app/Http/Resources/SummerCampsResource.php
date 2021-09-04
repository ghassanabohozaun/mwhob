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

        return [
            'id' => $this->id,
            'summer_camp_image' =>$image,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'short_description_ar' => $this->short_description_ar,
            'short_description_en' => $this->short_description_en,
            'status' => $status,
            'actions' => $options
        ];
    }
}
