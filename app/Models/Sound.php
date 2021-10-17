<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Sound extends Model
{
    use SoftDeletes;

    protected $table = 'sounds';
    protected $fillable = [
        'sound_image',
        'slug_name_ar',
        'slug_name_en',
        'name_ar',
        'name_en',
        'date',
        'length',
        'sound_file',
        'views',
        'language',
        'status',
    ];


    protected $hidden = ['updated_at'];

    //////////////////////////////////////////////////////////////
    /// Relations
    public function mawhobSound()
    {
        return $this->belongsTo('App\Models\MawhobSound', 'id', 'sound_id');
    }

    //////////////////////////////////////////////////
    /// get all sounds function
    public static function getSounds($search_name, $length_from, $length_to, $date_from, $date_to)
    {

        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $sounds = DB::table('sounds')->orderByDesc('id')
                ->where('status', 'on')->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                });
        } else {
            $sounds = DB::table('sounds')->orderByDesc('id')
                ->where('status', 'on')->where(function ($q) {
                    $q->where('language', 'ar_en');
                });
        }

        if ($search_name && !empty($search_name)) {
            if (LaravelLocalization::getCurrentLocale() == 'ar') {
                $sounds->where(function ($q) use ($search_name) {
                    $q->where('sounds.name_ar', 'like', "%{$search_name}%");
                });
            } else {
                $sounds->where(function ($q) use ($search_name) {
                    $q->where('sounds.name_en', 'like', "%{$search_name}%");
                });
            }
        }

        if (!empty($length_from) && !empty($length_to)) {
            $sounds->where('length', '>=', $length_from)
                ->where('length', '<=', $length_to);

        }

        if (!empty($date_from) && !empty($date_to)) {
            $sounds->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to);

        }


        return $sounds->paginate(12);
    }
}
