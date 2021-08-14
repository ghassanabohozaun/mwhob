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
        'mawhob_full_name',
        'mawhob_mobile_no',
        'mawhob_password',
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
