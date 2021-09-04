<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class StoryCategoryResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.success-stories.categories.parts.options', ['instance' => $this])->render();
        $icon = view('admin.success-stories.categories.parts.icon', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'category_icon' =>$icon,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'actions' => $options
        ];
    }
}
