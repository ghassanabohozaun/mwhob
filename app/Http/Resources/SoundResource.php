<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class SoundResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.sounds.parts.options', ['instance' => $this])->render();
        $image = view('admin.sounds.parts.image', ['instance' => $this])->render();
        $status = view('admin.sounds.parts.status', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'sound_image' =>$image,
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
