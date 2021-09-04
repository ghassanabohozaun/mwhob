<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class ProgramResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.programs.parts.options', ['instance' => $this])->render();
        $icon = view('admin.programs.parts.icon', ['instance' => $this])->render();
        $workPlane = view('admin.programs.parts.work-plane', ['instance' => $this])->render();
        $status = view('admin.programs.parts.status', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'icon' =>$icon,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'hours' => $this->hours,
            'date' => $this->date,
            'price' =>  $this->price,
            'work_plan' => $workPlane,
            'status' => $status,
            'actions' => $options
        ];
    }
}
