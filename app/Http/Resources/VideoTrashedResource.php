<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class VideoTrashedResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.videos.parts.trashed-options', ['instance' => $this])->render();
        $image = view('admin.videos.parts.image', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'video_image' =>$image,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'date' => $this->date,
            'length' => $this->length,
            'views' => $this->views,
            'actions' => $options
        ];
    }
}
