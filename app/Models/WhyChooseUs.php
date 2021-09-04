<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{

    protected $table = 'why_choose_us';
    protected $fillable = [
        'why_choose_us_ar',
        'why_choose_us_en',
        'reason_1',
        'reason_2',
        'reason_3',
        'reason_4',
        'reason_5',
        'reason_6',
        'reason_7',
        'reason_en_1',
        'reason_en_2',
        'reason_en_3',
        'reason_en_4',
        'reason_en_5',
        'reason_en_6',
        'reason_en_7',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
