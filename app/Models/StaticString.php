<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticString extends Model
{

    protected $table = 'static_strings';
    protected $fillable = [
        'talents_description_ar',
        'talents_description_en',
        'soundtrack_description_ar',
        'soundtrack_description_en',
        'videos_description_ar',
        'videos_description_en',
        'success_stories_description_ar',
        'success_stories_description_en',
        'success_story_categories_description_ar',
        'success_story_categories_description_en',
        'success_story_description_ar',
        'success_story_description_en',
        'success_story_person_description_ar',
        'success_story_person_description_en',
        'programs_description_ar',
        'programs_description_en',
        'courses_description_ar',
        'courses_description_en',
        'contests_description_ar',
        'contests_description_en',
        'summer_camps_description_ar',
        'summer_camps_description_en',
        'magazine_description_ar',
        'magazine_description_en',
        'latest_winners_description_ar',
        'latest_winners_description_en',
        'terms_of_registration_for_the_contest_ar',
        'terms_of_registration_for_the_contest_en',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
