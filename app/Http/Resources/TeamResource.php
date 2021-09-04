<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class TeamResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.landing-page.teams.parts.options', ['instance' => $this])->render();
        $image = view('admin.landing-page.teams.parts.image', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'team_image' =>$image,
            'name_ar' =>$this->name_ar,
            'name_en' =>$this->name_en,
            'position_ar' =>$this->position_ar,
            'position_en' =>$this->position_en,
            'actions' => $options
        ];
    }
}
