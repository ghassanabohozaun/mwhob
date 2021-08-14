<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    protected $table = 'programs';
    protected $fillable = [
        'icon',
        'name_ar',
        'name_en',
        'short_description_ar',
        'short_description_en',
        'hours',
        'work_plan',
        'date',
        'price',
        'language',
        'status',
    ];


    protected $hidden = ['created_at', 'updated_at'];
}
