<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'course_image',
        'slug_title_ar',
        'slug_title_en',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'hours',
        'cost',
        'discount',
        'category_id',
        'teacher_id',
        'zoom_link',
        'language',
        'status',
        'active',
        'start_at',
        'end_at',
    ];
    protected $hidden = ['updated_at'];


    //////////////////////////////////////////////////////////////
    /// Relations
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id', 'id');
    }

    //////////////////////////////////////////////////////////////
    public function mawhobEnrollCourse()
    {
        return $this->hasMany('App\Models\MawhobEnrollCourse', 'course_id', 'id');
    }

}
