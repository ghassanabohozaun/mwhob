<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{

    protected $table = 'lectures';
    protected $fillable = [
        'course_id',
        'lecture_date',
        'lecture_from',
        'lecture_to',
        'status',
        'lecture_cancel',
    ];

    protected $hidden = ['updated_at'];

    //////////////////////////////////////////////////////////////
    /// Relations

    public function lectureMawhobs()
    {
        return $this->hasMany('App\Models\lecture_mawhob', 'lecture_id', 'id');
    }

}
