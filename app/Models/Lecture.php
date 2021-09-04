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
        'status'
    ];

    protected $hidden = ['updated_at'];

}
