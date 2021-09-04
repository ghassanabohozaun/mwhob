<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class VideoResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.videos.parts.options', ['instance' => $this])->render();
        $image = view('admin.videos.parts.image', ['instance' => $this])->render();
        $status = view('admin.videos.parts.status', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'video_image' =>$image,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'date' => $this->date,
            'length' => $this->length,
            'views' => $this->views,
            'status' => $status,
            'actions' => $options
        ];
    }
}
