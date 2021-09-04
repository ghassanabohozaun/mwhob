<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestMawhob extends Model
{
    protected $table = 'best_mawhobs';
    protected $fillable = [
        'mawhob_id'
    ];
    protected $hidden = ['created_at', 'updated_at'];


    //////////////////////////////////////////////////////////////
    /// Relations
    public function mawhob()
    {
        return $this->hasOne('App\Models\Mawhob', 'id', 'mawhob_id');
    }

}
