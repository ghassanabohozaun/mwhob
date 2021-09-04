<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class SummerCampsTrashedResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.summer-camps.parts.trashed-options', ['instance' => $this])->render();
        $image = view('admin.summer-camps.parts.image', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'summer_camp_image' =>$image,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'short_description_ar' => $this->short_description_ar,
            'short_description_en' => $this->short_description_en,
            'actions' => $options
        ];
    }
}
