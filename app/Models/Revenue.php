<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{

    protected $table = 'revenues';
    protected $fillable = [
        'mawhob_id',
        'date',
        'value',
        'revenue_for',
        'details',
    ];
    protected $hidden = ['updated_at'];
    //////////////////////////////////////////////////////////////
    /// Relations
    public function mawhob()
    {
        return $this->belongsTo('App\Models\Mawhob', 'mawhob_id', 'id');
    }


    //////////////////////////////////// accessors ///////////////////////
    /// details accessors
    public function getDetailsAttribute($value)
    {
        if ($value == 'enroll_course') {
            return trans('revenues.enroll_course');
        } elseif ($value == 'enroll_program') {
            return trans('revenues.enroll_program');
        } elseif ($value == 'enroll_contest') {
            return trans('revenues.enroll_contest');
        }

    }
}
