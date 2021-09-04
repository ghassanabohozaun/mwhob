<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{

    use SoftDeletes;
    protected $table = 'stories';
    protected $fillable = [
        'story_icon',
        'story_image',
        'about_mawhob_ar',
        'about_mawhob_en',
        'mawhob_id',
        'story_category_id',
        'status',
        'language',
    ];
    protected $hidden = ['updated_at'];


    //////////////////////////////////////////////////////////////
    /// Relations
    public function mawhob(){
        return $this->belongsTo('App\Models\Mawhob','mawhob_id','id');
    }

    public function storyCategory(){
        return $this->belongsTo('App\Models\StoryCategory','story_category_id','id');
    }
}
