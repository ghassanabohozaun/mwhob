<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mawhob extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'mawhobs';
    protected $fillable = [
        'photo',
        'slug_mawhob_full_name',
        'mawhob_full_name',
        'mawhob_mobile_no',
        'password',
        'mawhob_whatsapp_no',
        'mawhob_birthday',
        'mowhob_gender',
        'category_id',
        'portfolio',
        'freeze',
    ];

    protected $hidden = ['updated_at'];
    //////////////////////////////////////////////////////////////
    /// Relations
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    //////////////////////////////////////////////////////////////
    public function mawhobEnrolledContest()
    {
        return $this->hasMany('App\Models\MawhobEnrolledContest', 'mawhob_id', 'id');
    }

    public function mawhobSound(){
        return $this->hasMany('App\Models\MawhobSound','mawhob_id','id');
    }

    public function revenue(){
        return $this->hasMany('App\Models\Revenue','mawhob_id','id');
    }

    public function bestMawhob(){
        return $this->hasMany('App\Models\BestMawhob','mawhob_id','id');
    }

    public function mawhobEnrollCourse(){
        return $this->hasMany('App\Models\MawhobEnrollCourse','mawhob_id','id');
    }

    public function mawhobEnrollProgram(){
        return $this->hasMany('App\Models\MawhobEnrollProgram','mawhob_id','id');
    }



    //////////////////////////////////// accessors ///////////////////////
    /// Gender accessors
    public function getMowhobGenderAttribute($value)
    {
        if ($value == 'male') {
            return trans('general.male');
        } elseif ($value == 'female') {
            return trans('general.female');
        }
    }
}
