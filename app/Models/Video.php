<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Video extends Model
{
    use SoftDeletes;


    protected $table = 'videos';
    protected $fillable = [
        'video_image',
        'slug_name_ar',
        'slug_name_en',
        'name_ar',
        'name_en',
        'date',
        'length',
        'video_class',
        'youtube_link',
        'vimeo_link',
        'upload_video_link',
        'short_youtube_link',
        'short_vimeo_link',
        'short_upload_video_link',
        'views',
        'language',
        'status',
    ];
    protected $hidden = ['updated_at'];

    //////////////////////////////////////////////////////////////
    /// Relations
    public function mawhobVideo()
    {
        return $this->belongsTo('App\Models\MawhobVideo', 'id', 'video_id');
    }



    //////////////////////////////////////////////////
    /// get all videos function
    public static function getVideos($search_name, $length_from, $length_to, $date_from, $date_to)
    {

        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $videos = DB::table('videos')->orderByDesc('id')
                ->where('status', 'on')->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                });
        }else{
            $videos = DB::table('videos')->orderByDesc('id')
                ->where('status', 'on')->where(function ($q) {
                    $q->where('language', 'ar_en');
                });
        }

        if ($search_name && !empty($search_name)) {
            if (LaravelLocalization::getCurrentLocale() == 'ar') {
                $videos->where(function ($q) use ($search_name) {
                    $q->where('videos.name_ar', 'like', "%{$search_name}%");
                });
            } else {
                $videos->where(function ($q) use ($search_name) {
                    $q->where('videos.name_en', 'like', "%{$search_name}%");
                });
            }
        }

        if (!empty($length_from) && !empty($length_to)) {
            $videos->where('length', '>=', $length_from)
                ->where('length', '<=', $length_to);

        }

        if (!empty($date_from) && !empty($date_to)) {
            $videos->where('date', '>=', $date_from)
                ->where('date', '<=', $date_to);

        }


        return $videos->paginate(12);
    }

}
