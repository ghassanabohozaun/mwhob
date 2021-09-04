<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class SliderResource extends JsonResource
{
    public function toArray($request)
    {
        $options = view('admin.landing-page.sliders.parts.options', ['instance' => $this])->render();
        $photo = view('admin.landing-page.sliders.parts.photo', ['instance' => $this])->render();
        $status = view('admin.landing-page.sliders.parts.status', ['instance' => $this])->render();
        $detailsStatus = view('admin.landing-page.sliders.parts.details_status', ['instance' => $this])->render();
        $buttonStatus = view('admin.landing-page.sliders.parts.button_status', ['instance' => $this])->render();


        return [
            'id' => $this->id,
            'photo' => $photo,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'details_status' => $detailsStatus,
            'button_status' => $buttonStatus,
            'status' => $status,
            'actions' => $options
        ];
    }
}
