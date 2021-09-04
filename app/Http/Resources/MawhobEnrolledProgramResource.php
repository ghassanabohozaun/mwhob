<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class MawhobEnrolledProgramResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.programs.enrolled-list.parts.options', ['instance' => $this])->render();
        $mawhob_id = view('admin.programs.enrolled-list.parts.mawhobID', ['instance' => $this->mawhob])->render();

        return [
            'id' => $this->id,
            'mawhob_id' => $mawhob_id,
            'enrolled_date' => $this->enrolled_date,
            'actions' => $options
        ];
    }
}
