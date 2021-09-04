<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterImage extends Model
{
    protected $table = 'footer_images';
    protected $fillable = [
        'footer_image',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
