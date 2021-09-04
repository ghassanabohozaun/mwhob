<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryCategory extends Model
{
    protected $table = 'story_categories';
    protected $fillable = [
        'category_icon',
        'slug_name_ar',
        'slug_name_en',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'language',
    ];

    protected $hidden = ['updated_at'];
}
