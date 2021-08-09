<?php

namespace App\Models\Teachers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'teachers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'mobile',
        'gender',
        'status',
        'last_login_at',
        'last_login_ip',
        'remember_token'
    ];
    protected $hidden = ['created_at', 'updated_at', 'remember_token'];
}
