<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    protected $fillable = [
        'icon',
        'slug_name_ar',
        'slug_name_en',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'field',
        'language'
    ];
    protected $hidden = ['updated_at'];

    //////////////////////////////////////////////////////////////
    /// Relations

    public function teacherCategory(){
        return $this->hasOne('App\Models\Teacher_Category','category_id');
    }

    public function mowhobs(){
        return $this->hasMany('App\Models\Mawhob','category_id','id');
    }


    public function courses(){
        return $this->hasMany('App\Models\Course','category_id','id');

    }

    //////////////////////////////////// accessors ///////////////////////
    /// Field accessors
    public function getFieldAttribute($value)
    {
        if ($value == 'courses') {
            return trans('categories.courses');
        } elseif ($value == 'mawhobs') {
            return trans('categories.mawhobs');
        }elseif ($value == 'teachers') {
            return trans('categories.teachers');
        }
    }
}
