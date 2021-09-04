<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class MawhobEnrolledContestResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.contests.enrolled-list.parts.options', ['instance' => $this])->render();
        $mawhob_id = view('admin.contests.enrolled-list.parts.mawhobID', ['instance' => $this->mawhob])->render();
        $mawhobWinner = view('admin.contests.enrolled-list.parts.mawhobWinner', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'mawhob_id' => $mawhob_id,
            'enrolled_date' => $this->enrolled_date,
            'mawhob_winner' =>$mawhobWinner,
            'mawhob_winner_description_ar' => $this->mawhob_winner_description_ar,
            'mawhob_winner_description_en' => $this->mawhob_winner_description_en,
            'actions' => $options
        ];
    }
}
