<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    protected $fillable = [
        'team_image',
        'name_ar',
        'name_en',
        'position_ar',
        'position_en',
    ];
    protected $hidden = ['updated_at'];
}
