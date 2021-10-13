<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class AttendanceRecordResource extends JsonResource
{
    public function toArray($request)
    {
        $options = view('admin.courses.lectures.attendance-record-parts.options', ['instance' => $this])->render();
        $mwhobName = view('admin.courses.lectures.attendance-record-parts.mwhob-name', ['instance' => $this->mawhob])->render();
        $status = view('admin.courses.lectures.attendance-record-parts.status', ['instance' => $this->mawhob])->render();

        return [
            'id' => $this->id,
            'mwhob_name' =>$mwhobName,
            'status' =>$status,
            'actions' => $options
        ];
    }
}
