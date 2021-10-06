<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use View;
class StoryTrashedResource extends JsonResource
{
    public function toArray($request)
    {

        $options = view('admin.success-stories.parts.trashed-options', ['instance' => $this])->render();
        $icon = view('admin.success-stories.parts.icon', ['instance' => $this])->render();
        $image = view('admin.success-stories.parts.image', ['instance' => $this])->render();
        $mawhob = view('admin.success-stories.parts.mawhob', ['instance' => $this->mawhob])->render();
        $category = view('admin.success-stories.parts.category', ['instance' => $this->storyCategory])->render();
        $date = view('admin.success-stories.parts.date', ['instance' => $this])->render();

        return [
            'id' => $this->id,
            'story_icon' =>$icon,
            'story_image' =>$image,
            'mawhob_id' =>$mawhob,
            'story_category_id' => $category,
            'created_at' =>$date,
            'actions' => $options
        ];
    }
}
