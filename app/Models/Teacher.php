<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'teachers';
    protected $fillable = [
        'teacher_photo',
        'teacher_full_name',
        'teacher_email',
        'teacher_bio',
        'password',
        'teacher_mobile_no',
        'teacher_whatsapp_no',
        'teacher_qualification',
        'teacher_cv',
        'teacher_photos_and_videos_link',
        'teacher_gender',
        'teacher_freeze',

        'teacher_last_login_at',
        'teacher_last_login_ip',
        'teacher_remember_token',
    ];
    protected $hidden = ['updated_at', 'remember_token'];
    //////////////////////////////////// accessors ///////////////////////
    /// Gender accessors
    public function getTeacherGenderAttribute($value)
    {
        if ($value == 'male') {
            return trans('general.male');
        } elseif ($value == 'female') {
            return trans('general.female');
        }
    }
}
