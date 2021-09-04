<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutMawhob extends Model
{
    protected $table = 'about_mawhobs';
    protected $fillable = [
        'title_ar',
        'title_en',
        'summary_ar',
        'summary_en',
        'details_ar',
        'details_en',
        'video',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
