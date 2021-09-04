<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class RevenueResource extends JsonResource
{
    public function toArray($request)
    {

        $mawhobID = view('admin.revenues.parts.mawhobID', ['instance' => $this->mawhob])->render();
        $date = view('admin.revenues.parts.date', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'mawhob_id' =>$mawhobID,
            'value' => $this->value,
            'date' => $date,
            'details' => $this->details,
        ];
    }
}
