<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MawhobSound extends Model
{
    protected $table = 'mawhob_sounds';
    protected $fillable = [
        'sound_id',
        'mawhob_id',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    //////////////////////////////////////////////////////////////
    /// Relations
    public function mawhob()
    {
        return $this->hasOne('App\Models\Mawhob', 'id', 'mawhob_id');
    }

    public function sound()
    {
        return $this->hasOne('App\Models\Sound', 'id', 'sound_id');
    }
}
