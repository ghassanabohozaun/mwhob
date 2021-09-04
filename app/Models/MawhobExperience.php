<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MawhobExperience extends Model
{
    protected $table = 'mawhob_experiences';
    protected $fillable = [
        'mawhob_id',
        'story_id',
        'experience_name_ar',
        'experience_name_en',
        'experience_percentage',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
