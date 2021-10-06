<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationPolicy extends Model
{

    protected $table = 'registration_policies';
    protected $fillable = [
        'policy_title_ar',
        'policy_title_en',
        'policy_details_ar',
        'policy_details_en',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
