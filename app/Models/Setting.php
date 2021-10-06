<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'site_name_ar',
        'site_name_en',
        'site_email',
        'site_gmail',
        'site_facebook',
        'site_twitter',
        'site_youtube',
        'site_instagram',
        'site_phone',
        'site_mobile',
        'site_lang_ar',
        'site_lang_en',
        'lang_front_button_status',
        'site_description_ar',
        'site_description_en',
        'site_keywords_ar',
        'site_keywords_en',
        'site_icon',
        'site_logo',
    ];
}
