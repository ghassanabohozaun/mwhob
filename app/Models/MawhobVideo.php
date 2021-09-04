<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MawhobVideo extends Model
{
    protected $table = 'mawhob_videos';
    protected $fillable = [
        'video_id',
        'mawhob_id',
    ];
    protected $hidden = ['updated_at'];
     //////////////////////////////////////////////////////////////
    /// Relations
    public function mawhob()
    {
        return $this->hasOne('App\Models\Mawhob', 'id', 'mawhob_id');
    }

    public function video()
    {
        return $this->hasOne('App\Models\Video', 'id', 'video_id');
    }
}
