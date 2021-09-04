<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MawhobEnrollCourse extends Model
{
    protected $table = 'mawhob_enroll_courses';
    protected $fillable = [
        'course_id',
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

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }
}
