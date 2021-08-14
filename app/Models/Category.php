<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = [
        'icon',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'field',
        'language'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    //////////////////////////////////////////////////////////////
    /// Relations

    public function teacherCategory(){
        return $this->hasOne('App\Models\Teacher_Category','category_id');
    }

    public function mowhobs(){
        return $this->hasMany('App\Models\Mawhob','category_id','id');
    }
    //////////////////////////////////// accessors ///////////////////////
    /// Gender accessors
    public function getFieldAttribute($value)
    {
        if ($value == 'courses') {
            return trans('categories.courses');
        } elseif ($value == 'success_stories') {
            return trans('categories.success_stories');
        }
    }
}
