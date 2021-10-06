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
        'slug_name_ar',
        'slug_name_en',
        'name_ar',
        'name_en',
        'short_description_ar',
        'short_description_en',
        'hours',
        'work_plan',
        'date',
        'price',
        'discount',
        'language',
        'status',
    ];

    protected $hidden = ['updated_at'];
    //////////////////////////////////////////////////////////////
    public function mawhobEnrollProgram()
    {
        return $this->hasMany('App\Models\MawhobEnrollProgram', 'program_id', 'id');
    }
}
