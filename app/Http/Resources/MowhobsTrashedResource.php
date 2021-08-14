<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class MowhobsTrashedResource extends JsonResource
{
    public function toArray($request)
    {
        $options = view('admin.mowhobs.parts.trashed_options', ['instance' => $this])->render();
        $photo = view('admin.mowhobs.parts.photo', ['instance' => $this])->render();
        $portfolio = view('admin.mowhobs.parts.portfolio', ['instance' => $this])->render();
        $categoryID = view('admin.mowhobs.parts.categoryID', ['instance' => $this->category])->render();

        return [
            'id' => $this->id,
            'photo' => $photo,
            'mawhob_full_name' => $this->mawhob_full_name,
            'mawhob_mobile_no' => $this->mawhob_mobile_no,
            'mawhob_whatsapp_no' => $this->mawhob_whatsapp_no,
            'mawhob_birthday' => $this->mawhob_birthday,
            'category_id' => $categoryID,
            'portfolio' => $portfolio,
            'actions' => $options
        ];
    }
}
