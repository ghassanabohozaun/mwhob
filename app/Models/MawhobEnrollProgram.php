<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MawhobEnrollProgram extends Model
{
    protected $table = 'mawhob_enroll_programs';
    protected $fillable = [
        'program_id',
        'mawhob_id',
        'enrolled_date',
    ];
    protected $hidden = ['updated_at'];

    //////////////////////////////////////////////////////////////
    /// Relations
    public function mawhob()
    {
        return $this->hasOne('App\Models\Mawhob', 'id', 'mawhob_id');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\Program', 'program_id', 'id');
    }
}
