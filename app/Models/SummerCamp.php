<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SummerCamp extends Model
{
    use SoftDeletes;

    protected $table = 'summer_camps';
    protected $fillable = [
        'summer_camp_image',
        'slug_name_ar',
        'slug_name_en',
        'name_ar',
        'name_en',
        'short_description_ar',
        'short_description_en',
        'status',
        'language',
    ];

    protected $hidden = ['updated_at'];
}
