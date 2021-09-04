<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contest extends Model
{
    use SoftDeletes;

    protected $table = 'contests';
    protected $fillable = [
        'contest_image',
        'slug_name_ar',
        'slug_name_en',
        'name_ar',
        'name_en',
        'short_description_ar',
        'short_description_en',
        'end_date',
        'prize',
        'language',
        'status',
    ];
    protected $hidden = ['updated_at'];

    //////////////////////////////////////////////////////////////
    public function ContestEnrolled()
    {
        return $this->hasMany('App\Models\MawhobEnrolledContest', 'contest_id', 'id');
    }

}
