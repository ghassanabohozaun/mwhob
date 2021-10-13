<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lecture_mawhob extends Model
{
    protected $table = 'lecture_mawhobs';

    protected $fillable = [
        'course_id',
        'lecture_id',
        'mawhob_id',
        'status',
    ];

    protected $hidden = ['updated_at'];

    //////////////////////////////////////////////////////////////
    /// Relations

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }

    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture', 'lecture_id', 'id');
    }

    public function mawhob()
    {
        return $this->belongsTo('App\Models\Mawhob', 'mawhob_id', 'id');
    }
}
