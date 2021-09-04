<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Http\Resources\VideoResource;
use App\Http\Resources\VideoTrashedResource;
use App\Models\Mawhob;
use App\Models\MawhobVideo;
use App\Models\Video;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideosController extends Controller
{
    use GeneralTrait;

    /////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.videos');
        return view('admin.videos.index', compact('title'));
    }

    ////////////////////////////////////////
    /// Get Videos
    public function getVideos(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }

        if (!empty($request->search_name)) {
            $searchQuery = $request->search_name;
            $requestData = ['name_ar', 'name_en'];
            $list = Video::where(function ($q) use ($requestData, $searchQuery) {
                foreach ($requestData as $field)
                    $q->orWhere($field, 'like', "%{$searchQuery}%");
            })->get();
        } elseif (!empty($request->status)) {
            if ($request->status == 'disable') {
                $status_vale = null;
            } else {
                $status_vale = 'on';
            }
            $list = Video::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('status', '=', $status_vale)
                ->get();
        } elseif (!empty($request->date_from) && !empty($request->date_to)) {
            $list = Video::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('date', '>=', $request->date_from)
                ->where('date', '<=', $request->date_to)
                ->get();
        } elseif (!empty($request->date_from)) {
            $list = Video::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('date', '=', $request->date_from)
                ->get();

        } else {
            $list = Video::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)->get();
        }


        $arr = VideoResource::collection($list);
        $recordsTotal = Video::get()->count();
        $recordsFiltered = Video::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    /////////////////////////////////////////
    /// Get Trashed Videos index
    public function trashedVideos()
    {
        $title = trans('videos.trashed_videos');
        return view('admin.videos.trashed-videos', compact('title'));
    }

    ////////////////////////////////////////
    ///  Get Trashed Videos
    public function getTrashedVideos(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }

        $list = Video::onlyTrashed()->orderByDesc('created_at')
            ->offset($offset)->take($perPage)->get();
        $arr = VideoTrashedResource::collection($list);
        $recordsTotal = Video::get()->count();
        $recordsFiltered = Video::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    ////////////////////////////////////////////
    /// create Video
    public function create()
    {
        $title = trans('menu.add_new_video');
        $mawhobs = Mawhob::get();
        return view('admin.videos.create', compact('title', 'mawhobs'));
    }


    ////////////////////////////////////////////
    /// user define get Youtube  Link function
    protected function YoutubeLink($link)
    {
        /// YouTube
        if (preg_match('@^(?:https://(?:www\\.)?youtube.com/)(watch\\?v=|v/)([a-zA-Z0-9_]*)@', $link, $match)) {
            if (strlen($link) > 11) {
                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                    $link, $match)) {
                    $shortLink = $match[1];
                    $fullLink = 'https://www.youtube.com/embed/' . $match[1];
                    return [$shortLink, $fullLink];
                } else {
                    $shortLink = '0';
                    $fullLink = 'https://www.youtube.com/embed/' . '0';
                    return [$shortLink, $fullLink];
                }
            }
        } else {
            return $this->returnError(trans('videos.url_invalid'), '500');
        }
    }

    ////////////////////////////////////////////
    /// user define get vimeo Link function

    protected function VimeoLink($link)
    {
        if (preg_match('@^(?:https://(?:www\\.)?vimeo.com/)([a-zA-Z0-9_]*)@', $link, $match)) {
            $stringParts = explode("com/", $link);
            $shortLink = $stringParts[1];
            $fullLink = "https://player.vimeo.com/video/" . $shortLink . "?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media";
            return [$shortLink, $fullLink];
        } else {
            return $this->returnError(trans('videos.url_invalid'), '500');
        }
    }


    /////////////////////////////////////////////
    /// store videos
    public function store(VideoRequest $request)
    {

        try {
            if ($request->input('video_class') == 'youtube') {
                $shortLink = $this->YoutubeLink($request->input('youtube_link'))[0];
                $fullLink = $this->YoutubeLink($request->input('youtube_link'))[1];

                /// vimeo
            } elseif ($request->input('video_class') == 'vimeo') {
                $shortLink = $this->VimeoLink($request->input('vimeo_link'))[0];
                $fullLink = $this->VimeoLink($request->input('vimeo_link'))[1];

                /// uploaded_video
            } elseif ($request->input('video_class') == 'uploaded_video') {
                $shortLink = $request->file('upload_video_link')->store('VideosFile');
                $fullLink = url('/') . '/storage/' . $shortLink;
            }

            if ($request->has('video_image')) {
                $image_path = $request->file('video_image')->store('VideosImages');
            } else {
                $image_path = '';
            }


            if (setting()->site_lang_en == 'on') {
                ////////////////////////////////////////////////////////////////////
                /// Youtube
                if ($request->input('video_class') == 'youtube') {
                    $video = Video::create([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' => slug($request->name_en),
                        'name_ar' => $request->name_ar,
                        'name_en' => $request->name_en,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $request->video_class,
                        'youtube_link' => $fullLink,
                        'vimeo_link' => null,
                        'upload_video_link' => null,
                        'short_youtube_link' => $shortLink,
                        'short_vimeo_link' => null,
                        'short_upload_video_link' => null,
                        'language' => 'ar_en',
                    ]);
                    ////////////////////////////////////////////////////////////////////
                    /// vimeo
                } else if ($request->input('video_class') == 'vimeo') {
                    $video = Video::create([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' => slug($request->name_en),
                        'name_ar' => $request->name_ar,
                        'name_en' => $request->name_en,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $request->video_class,
                        'youtube_link' => null,
                        'vimeo_link' => $fullLink,
                        'upload_video_link' => null,
                        'short_youtube_link' => null,
                        'short_vimeo_link' => $shortLink,
                        'short_upload_video_link' => null,
                        'language' => 'ar_en',]);
                    ////////////////////////////////////////////////////////////////////
                    /// Uploaded Video
                } else {
                    $video = Video::create([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' => slug($request->name_en),
                        'name_ar' => $request->name_ar,
                        'name_en' => $request->name_en,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $request->video_class,
                        'youtube_link' => null,
                        'vimeo_link' => null,
                        'upload_video_link' => $fullLink,
                        'short_youtube_link' =>null ,
                        'short_vimeo_link' => null,
                        'short_upload_video_link' => $shortLink,
                        'language' => 'ar_en',
                    ]);
                }
            } else {
                ////////////////////////////////////////////////////////////////////
                /// Youtube
                if ($request->input('video_class') == 'youtube') {
                    $video = Video::create([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' =>null,
                        'name_ar' => $request->name_ar,
                        'name_en' => null,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $request->video_class,
                        'youtube_link' => $fullLink,
                        'vimeo_link' => null,
                        'upload_video_link' => null,
                        'short_youtube_link' => $shortLink,
                        'short_vimeo_link' => null,
                        'short_upload_video_link' => null,
                        'language' => 'ar',
                    ]);
                    ////////////////////////////////////////////////////////////////////
                    /// vimeo
                } else if ($request->input('video_class') == 'vimeo') {
                    $video = Video::create([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' =>null,
                        'name_ar' => $request->name_ar,
                        'name_en' => null,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $request->video_class,
                        'youtube_link' => null,
                        'vimeo_link' => $fullLink,
                        'upload_video_link' => null,
                        'short_youtube_link' => null,
                        'short_vimeo_link' => $shortLink,
                        'short_upload_video_link' => null,
                        'language' => 'ar',
                        ]);
                    ////////////////////////////////////////////////////////////////////
                    /// Uploaded Video
                } else {
                    $video = Video::create([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' =>null,
                        'name_ar' => $request->name_ar,
                        'name_en' => null,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $request->video_class,
                        'youtube_link' => null,
                        'vimeo_link' => null,
                        'upload_video_link' => $fullLink,
                        'short_youtube_link' => null,
                        'short_vimeo_link' => null,
                        'short_upload_video_link' => $shortLink,
                        'language' => 'ar',
                    ]);
                }
            }

            if ($request->has('mawhobs')) {
                foreach ($request->input('mawhobs') as $mawhob) {
                    $mawhobVideo = new MawhobVideo();
                    $mawhobVideo->video_id = $video->id;
                    $mawhobVideo->mawhob_id = $mawhob;
                    $mawhobVideo->save();
                }
            }
            return $this->returnSuccessMessage(trans('general.add_success_message'));


        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// edit video
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $video = Video::find($id);
        if (!$video) {
            return redirect()->route('admin.not.found');
        }

        $mawhobs = Mawhob::get();
        $title = trans('videos.update_video');
        return view('admin.videos.update', compact('title', 'video', 'mawhobs'));
    }

    /////////////////////////////////////////////
    /// update video
    public function update(VideoUpdateRequest $request)
    {
        try {
            $video = Video::find($request->id);
            if (!$video) {
                return redirect()->route('admin.not.found');
            }

            if ($request->input('video_class') == 'youtube') {
                $statusClass = 'youtube';
                $shortLink = $this->YoutubeLink($request->input('youtube_link'))[0];
                $fullLink = $this->YoutubeLink($request->input('youtube_link'))[1];

                /// vimeo
            } elseif ($request->input('video_class') == 'vimeo') {
                $statusClass = 'vimeo';
                $shortLink = $this->VimeoLink($request->input('vimeo_link'))[0];
                $fullLink = $this->VimeoLink($request->input('vimeo_link'))[1];

                /// uploaded_video
            } elseif ($request->input('video_class') == 'uploaded_video') {

                if ($request->hasFile('upload_video_link')) {
                    if (!empty($video->upload_video_link)) {
                        Storage::delete($video->short_upload_video_link);
                        $shortLink = $request->file('upload_video_link')->store('VideosFile');
                        $fullLink = url('/') . '/storage/' . $shortLink;
                        $statusClass = 'uploaded_video';
                    } else {
                        $shortLink = $request->file('upload_video_link')->store('VideosFile');
                        $fullLink = url('/') . '/storage/' . $shortLink;
                        $statusClass = 'uploaded_video';
                    }
                } else {
                    if (!empty($video->upload_video_link)) {
                        $shortLink = $video->short_upload_video_link;
                        $fullLink = $video->upload_video_link;
                        $statusClass = $video->video_class;
                    } else {
                        $shortLink = '';
                        $fullLink = '';
                        $statusClass = 'uploaded_video';
                    }
                }
            }

            if ($request->hasFile('video_image')) {
                if (!empty($video->video_image)) {
                    Storage::delete($video->video_image);
                    $image_path = $request->file('video_image')->store('VideosImages');
                } else {
                    $image_path = $request->file('video_image')->store('VideosImages');
                }
            } else {
                if (!empty($video->video_image)) {
                    $image_path = $video->video_image;
                } else {
                    $image_path = '';
                }
            }


            if (setting()->site_lang_en == 'on') {
                ////////////////////////////////////////////////////////////////////
                /// Youtube
                if ($request->input('video_class') == 'youtube') {
                    $video->update([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' => slug($request->name_en),
                        'name_ar' => $request->name_ar,
                        'name_en' => $request->name_en,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $statusClass,
                        'youtube_link' => $fullLink,
                        'vimeo_link' => null,
                        'upload_video_link' => null,
                        'short_youtube_link' => $shortLink,
                        'short_vimeo_link' => null,
                        'short_upload_video_link' => null,
                        'language' => 'ar_en',
                    ]);
                    ////////////////////////////////////////////////////////////////////
                    /// vimeo
                } else if ($request->input('video_class') == 'vimeo') {
                    $video->update([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' => slug($request->name_en),
                        'name_ar' => $request->name_ar,
                        'name_en' => $request->name_en,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $statusClass,
                        'youtube_link' => null,
                        'vimeo_link' => $fullLink,
                        'upload_video_link' => null,
                        'short_youtube_link' => null,
                        'short_vimeo_link' => $shortLink,
                        'short_upload_video_link' => null,
                        'language' => 'ar_en',
                        ]);
                    ////////////////////////////////////////////////////////////////////
                    /// Uploaded Video
                } else {
                    $video->update([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' => slug($request->name_en),
                        'name_ar' => $request->name_ar,
                        'name_en' => $request->name_en,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $statusClass,
                        'youtube_link' => null,
                        'vimeo_link' => null,
                        'upload_video_link' => $fullLink,
                        'short_youtube_link' => null,
                        'short_vimeo_link' => null,
                        'short_upload_video_link' => $shortLink,
                        'language' => 'ar_en',
                    ]);
                }
            } else {
                ////////////////////////////////////////////////////////////////////
                /// Youtube
                if ($request->input('video_class') == 'youtube') {
                    $video->update([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' =>null,
                        'name_ar' => $request->name_ar,
                        'name_en' => null,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $statusClass,
                        'youtube_link' => $fullLink,
                        'vimeo_link' => null,
                        'upload_video_link' => null,
                        'short_youtube_link' => $shortLink,
                        'short_vimeo_link' => null,
                        'short_upload_video_link' => null,
                        'language' => 'ar',
                    ]);
                    ////////////////////////////////////////////////////////////////////
                    /// vimeo
                } else if ($request->input('video_class') == 'vimeo') {
                    $video->update([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' =>null,
                        'name_ar' => $request->name_ar,
                        'name_en' => null,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $statusClass,
                        'youtube_link' => null,
                        'vimeo_link' => $fullLink,
                        'upload_video_link' => null,
                        'short_youtube_link' => null,
                        'short_vimeo_link' => $shortLink,
                        'short_upload_video_link' => null,
                        'language' => 'ar',
                        ]);
                    ////////////////////////////////////////////////////////////////////
                    /// Uploaded Video
                } else {
                    $video->update([
                        'video_image' => $image_path,
                        'slug_name_ar' => slug($request->name_ar),
                        'slug_name_en' =>null,
                        'name_ar' => $request->name_ar,
                        'name_en' => null,
                        'date' => $request->date,
                        'length' => $request->length,
                        'video_class' => $statusClass,
                        'youtube_link' => null,
                        'vimeo_link' => null,
                        'upload_video_link' => $fullLink,
                        'short_youtube_link' => null,
                        'short_vimeo_link' => null,
                        'short_upload_video_link' => $shortLink,
                        'language' => 'ar',
                    ]);
                }
            }


            if ($request->has('mawhobs')) {
                MawhobVideo::where('video_id', $video->id)->delete();
                foreach ($request->input('mawhobs') as $mawhob) {
                    $mawhobVideo = new MawhobVideo();
                    $mawhobVideo->video_id = $video->id;
                    $mawhobVideo->mawhob_id = $mawhob;
                    $mawhobVideo->save();
                }
            }
            return $this->returnSuccessMessage(trans('general.update_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }


    /////////////////////////////////////////
    /// Video restore
    public function restore(Request $request)
    {
        try {
            if ($request->ajax()) {
                $video = Video::onlyTrashed()->find($request->id);
                if (!$video) {
                    return redirect()->route('admin.not.found');
                }
                $video->restore();
                return $this->returnSuccessMessage(trans('general.restore_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// Video destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $video = Video::find($request->id);
                if (!$video) {
                    return redirect()->route('admin.not.found');
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Video
                $mawhobVideo = MawhobVideo::where('video_id', $request->id)->get();
                if (!$mawhobVideo->isEmpty()) {
                    return $this->returnError([trans('videos.cannot_be_deleted_because_it_have_mawhobs')], 500);
                }


                $video->delete();
                return $this->returnSuccessMessage(trans('general.move_to_trash'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// Video force delete
    public function forceDestroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $video = Video::onlyTrashed()->find($request->id);
                if (!$video) {
                    return redirect()->route('admin.not.found');
                }

                if (!empty($video->video_image)) {
                    Storage::delete($video->video_image);
                }


                if (!empty($video->short_upload_video_link)) {
                    Storage::delete($video->short_upload_video_link);
                }
                MawhobVideo::where('video_id', $video->id)->delete();
                $video->forceDelete();
                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// Video change  status
    public function changeStatus(Request $request)
    {

        try {
            $video = Video::find($request->id);
            if ($request->switchStatus == 'false') {
                $video->status = null;
                $video->save();
            } else {
                $video->status = 'on';
                $video->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }


    ////////////////////////////////////////////
    /// view Video
    public function viewVideo(Request $request)
    {
        if ($request->ajax()) {
            $video = Video::find($request->id);
            return $this->returnData('OK', 'data', $video);
        }
    }
}
