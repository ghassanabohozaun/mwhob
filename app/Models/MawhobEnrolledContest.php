<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MawhobEnrolledContest extends Model
{
    protected $table = 'mawhob_enrolled_contests';

    protected $fillable = [
        'contest_id',
        'mawhob_id',
        'enrolled_date',
        'mawhob_winner',
        'mawhob_winner_description_ar',
        'mawhob_winner_description_en',
    ];

    protected $hidden = ['updated_at'];

    //////////////////////////////////////////////////////////////
    /// Relations
    public function mawhob()
    {
        return $this->belongsTo('App\Models\Mawhob', 'mawhob_id', 'id');
    }

    public function contest()
    {
        return $this->belongsTo('App\Models\Contest', 'contest_id', 'id');
    }

}
