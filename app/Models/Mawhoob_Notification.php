<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mawhoob_Notification extends Model
{
    use HasFactory;

    protected $table = 'mawhoob_notifications';
    protected $fillable = [
        'title_ar',
        'title_en',
        'details_ar',
        'details_en',
        'notify_status',
        'notify_class',
        'notify_for',
        'admin_id',
        'teacher_id',
        'student_id',
    ];
    protected $hidden = ['updated_at'];
}
