<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;

class SupportCenterResourece extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.support-center.parts.options', ['instance' => $this])->render();
        $status = view('admin.support-center.parts.status', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'title' => $this->title,
            'message' => $this->message,
            'status' => $status,
            'actions' => $options,
        ];
    }
}
