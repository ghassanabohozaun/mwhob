<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndexPage extends Model
{
    protected $table = 'index_pages';
    protected $fillable = [
        'mawhobs_description_ar',
        'mawhobs_description_en',
        'courses_description_ar',
        'courses_description_en',
        'best_mawhobs_description_ar',
        'best_mawhobs_description_en',
        'best_courses_description_ar',
        'best_courses_description_en',
        'about_team_ar',
        'about_team_en',

        'about_team_image',
        'best_app_image',
        'best_app_description_ar',
        'best_app_description_en',

        'our_mission_ar',
        'our_mission_en',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
