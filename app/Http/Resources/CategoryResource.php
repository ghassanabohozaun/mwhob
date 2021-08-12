<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class CategoryResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.categories.parts.options', ['instance' => $this])->render();
        $icon = view('admin.categories.parts.icon', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'icon' =>$icon,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'field' => $this->field,
            'actions' => $options
        ];
    }
}
