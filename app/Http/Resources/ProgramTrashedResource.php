<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class ProgramTrashedResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.programs.parts.trashed_options', ['instance' => $this])->render();
        $icon = view('admin.programs.parts.icon', ['instance' => $this])->render();
        $workPlane = view('admin.programs.parts.work-plane', ['instance' => $this])->render();
        $enrolledCount = view('admin.programs.parts.enrolledCount', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'icon' => $icon,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'hours' => $this->hours,
            'date' => $this->date,
            'price' => $this->price,
            'discount' => $this->discount,
            'enrolled_count' => $enrolledCount,
            'work_plan' => $workPlane,
            'actions' => $options
        ];
    }
}
