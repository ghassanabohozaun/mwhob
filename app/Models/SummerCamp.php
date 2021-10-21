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
        'year',
        'start_at',
        'end_at',
        'cost',
        'discount',
        'status',
        'enable_enrolling',
        'language',
    ];

    protected $hidden = ['updated_at'];

    //////////////////////////////////////////////////////////////
    public function mawhobEnrollSummerCamp()
    {
        return $this->hasMany('App\Models\MawhobEnrollSummerCamp', 'summer_camp_id', 'id');
    }
}
