<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher_Category extends Model
{
    protected $table = 'teacher_categories';
    protected $fillable = [
        'category_id',
        'teacher_id',
    ];
    protected $hidden = ['created_at', 'updated_at'];


    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }


}
