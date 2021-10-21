<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MawhobEnrollSummerCamp extends Model
{
    protected $table = 'mawhob_enroll_summer_camps';
    protected $fillable = [
        'summer_camp_id',
        'mawhob_id',
        'enrolled_date',
    ];
    protected $hidden = ['updated_at'];

    //////////////////////////////////////////////////////////////
    /// Relations
    public function mawhob()
    {
        return $this->hasOne('App\Models\Mawhob', 'id', 'mawhob_id');
    }

    public function summerCamp()
    {
        return $this->belongsTo('App\Models\SummerCamp', 'summer_camp_id', 'id');
    }
}
