<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class ContestTrashedResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.contests.parts.trashed-options', ['instance' => $this])->render();
        $image = view('admin.contests.parts.image', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'contest_image' => $image,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'short_description_ar' => $this->short_description_ar,
            'short_description_en' => $this->short_description_en,
            'end_date' => $this->end_date,
            'prize' => $this->prize,
            'actions' => $options
        ];
    }
}
