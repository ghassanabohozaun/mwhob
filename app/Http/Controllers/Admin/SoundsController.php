<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SoundRequest;
use App\Http\Requests\SoundUpdateRequest;
use App\Http\Resources\SoundResource;
use App\Http\Resources\SoundTrashedResource;
use App\Models\Mawhob;
use App\Models\MawhobSound;
use App\Models\MawhobVideo;
use App\Models\Sound;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SoundsController extends Controller
{
    use GeneralTrait;

    /////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.sounds');
        return view('admin.sounds.index', compact('title'));
    }

    ////////////////////////////////////////
    /// Get Sounds
    public function getSounds(Request $request)
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
            $list = Sound::where(function ($q) use ($requestData, $searchQuery) {
                foreach ($requestData as $field)
                    $q->orWhere($field, 'like', "%{$searchQuery}%");
            })->get();
        } elseif (!empty($request->status)) {
            if ($request->status == 'disable') {
                $status_vale = null;
            } else {
                $status_vale = 'on';
            }
            $list = Sound::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('status', '=', $status_vale)
                ->get();
        } elseif (!empty($request->date_from) && !empty($request->date_to)) {
            $list = Sound::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('date', '>=', $request->date_from)
                ->where('date', '<=', $request->date_to)
                ->get();
        } elseif (!empty($request->date_from)) {
            $list = Sound::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('date', '=', $request->date_from)
                ->get();

        } else {
            $list = Sound::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)->get();
        }


        $arr = SoundResource::collection($list);
        $recordsTotal = Sound::get()->count();
        $recordsFiltered = Sound::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    /////////////////////////////////////////
    /// Get Trashed Sounds index
    public function trashedSounds()
    {
        $title = trans('sounds.trashed_sounds');
        return view('admin.sounds.trashed-sounds', compact('title'));
    }

    ////////////////////////////////////////
    ///  Get Trashed Sounds
    public function getTrashedSounds(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }

        $list = Sound::onlyTrashed()->orderByDesc('created_at')
            ->offset($offset)->take($perPage)->get();
        $arr = SoundTrashedResource::collection($list);
        $recordsTotal = Sound::get()->count();
        $recordsFiltered = Sound::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }


    ////////////////////////////////////////////
    /// create sound
    public function create()
    {
        $title = trans('menu.add_new_sound');
        $mawhobs = Mawhob::get();
        return view('admin.sounds.create', compact('title', 'mawhobs'));
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
            return $this->returnError(trans('sounds.url_invalid'), '500');
        }
    }

    ////////////////////////////////////////////
    /// user define get vimeo  Link function

    protected function VimeoLink($link)
    {
        if (preg_match('@^(?:https://(?:www\\.)?vimeo.com/)([a-zA-Z0-9_]*)@', $link, $match)) {
            $stringParts = explode("com/", $link);
            $shortLink = $stringParts[1];
            $fullLink = "https://player.vimeo.com/video/" . $shortLink . "?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media";
            return [$shortLink, $fullLink];
        } else {
            return $this->returnError(trans('sounds.url_invalid'), '500');
        }
    }

    /////////////////////////////////////////////
    /// store sound
    public function store(SoundRequest $request)
    {

        if ($request->input('sound_class') == 'youtube') {
            $shortLink = $this->YoutubeLink($request->input('youtube_link'))[0];
            $fullLink = $this->YoutubeLink($request->input('youtube_link'))[1];

            /// vimeo
        } elseif ($request->input('sound_class') == 'vimeo') {
            $shortLink = $this->VimeoLink($request->input('vimeo_link'))[0];
            $fullLink = $this->VimeoLink($request->input('vimeo_link'))[1];

            /// uploaded_video
        } elseif ($request->input('sound_class') == 'uploaded_sound') {
            $shortLink = $request->file('upload_sound_link')->store('SoundsFile');
            $fullLink = url('/') . '/storage/' . $shortLink;
        }


        //// upload image
        if ($request->has('sound_image')) {
            $image_path = $request->file('sound_image')->store('SoundsImage');
        } else {
            $image_path = '';
        }


        if (setting()->site_lang_en == 'on') {
            ////////////////////////////////////////////////////////////////////
            /// Youtube
            if ($request->input('sound_class') == 'youtube') {
                $sound = Sound::create([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $request->sound_class,
                    'youtube_link' => $fullLink,
                    'vimeo_link' => null,
                    'upload_sound_link' => null,
                    'short_youtube_link' => $shortLink,
                    'short_vimeo_link' => null,
                    'short_upload_sound_link' => null,
                    'language' => 'ar_en',
                ]);
                ////////////////////////////////////////////////////////////////////
                /// vimeo
            } else if ($request->input('sound_class') == 'vimeo') {
                $sound = Sound::create([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $request->sound_class,
                    'youtube_link' => null,
                    'vimeo_link' => $fullLink,
                    'upload_sound_link' => null,
                    'short_youtube_link' => null,
                    'short_vimeo_link' => $shortLink,
                    'short_upload_sound_link' => null,
                    'language' => 'ar_en',]);
                ////////////////////////////////////////////////////////////////////
                /// Uploaded Video
            } else {
                $sound = Sound::create([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $request->sound_class,
                    'youtube_link' => null,
                    'vimeo_link' => null,
                    'upload_sound_link' => $fullLink,
                    'short_youtube_link' => null,
                    'short_vimeo_link' => null,
                    'short_upload_sound_link' => $shortLink,
                    'language' => 'ar_en',
                ]);
            }
        } else {
            ////////////////////////////////////////////////////////////////////
            /// Youtube
            if ($request->input('sound_class') == 'youtube') {
                $sound = Sound::create([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $request->sound_class,
                    'youtube_link' => $fullLink,
                    'vimeo_link' => null,
                    'upload_sound_link' => null,
                    'short_youtube_link' => $shortLink,
                    'short_vimeo_link' => null,
                    'short_upload_sound_link' => null,
                    'language' => 'ar',
                ]);
                ////////////////////////////////////////////////////////////////////
                /// vimeo
            } else if ($request->input('sound_class') == 'vimeo') {
                $sound = Sound::create([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $request->sound_class,
                    'youtube_link' => null,
                    'vimeo_link' => $fullLink,
                    'upload_sound_link' => null,
                    'short_youtube_link' => null,
                    'short_vimeo_link' => $shortLink,
                    'short_upload_sound_link' => null,
                    'language' => 'ar',]);
                ////////////////////////////////////////////////////////////////////
                /// Uploaded Video
            } else {
                $sound = Sound::create([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $request->sound_class,
                    'youtube_link' => null,
                    'vimeo_link' => null,
                    'upload_sound_link' => $fullLink,
                    'short_youtube_link' => null,
                    'short_vimeo_link' => null,
                    'short_upload_sound_link' => $shortLink,
                    'language' => 'ar',
                ]);
            }
        }

        if ($request->has('mawhobs')) {
            foreach ($request->input('mawhobs') as $mawhob) {
                $mawhobSound = new MawhobSound();
                $mawhobSound->sound_id = $sound->id;
                $mawhobSound->mawhob_id = $mawhob;
                $mawhobSound->save();
            }
        }
        return $this->returnSuccessMessage(trans('general.add_success_message'));


    }

    /////////////////////////////////////////
    /// edit sound
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $sound = Sound::find($id);
        if (!$sound) {
            return redirect()->route('admin.not.found');
        }

        $mawhobs = Mawhob::get();
        $title = trans('sounds.update_sound');
        return view('admin.sounds.update', compact('title', 'sound', 'mawhobs'));
    }

    /////////////////////////////////////////////
    /// update sound
    public function update(SoundUpdateRequest $request)
    {

        $sound = Sound::find($request->id);
        if (!$sound) {
            return redirect()->route('admin.not.found');
        }


        if ($request->input('sound_class') == 'youtube') {
            $statusClass = 'youtube';
            $shortLink = $this->YoutubeLink($request->input('youtube_link'))[0];
            $fullLink = $this->YoutubeLink($request->input('youtube_link'))[1];

            /// vimeo
        } elseif ($request->input('sound_class') == 'vimeo') {
            $statusClass = 'vimeo';
            $shortLink = $this->VimeoLink($request->input('vimeo_link'))[0];
            $fullLink = $this->VimeoLink($request->input('vimeo_link'))[1];

            /// uploaded_video
        } elseif ($request->input('sound_class') == 'uploaded_sound') {
            if ($request->hasFile('upload_sound_link')) {
                if (!empty($sound->upload_sound_link)) {
                    Storage::delete($sound->short_upload_sound_link);
                    $shortLink = $request->file('upload_sound_link')->store('SoundsFile');
                    $fullLink = url('/') . '/storage/' . $shortLink;
                    $statusClass = 'uploaded_sound';
                } else {
                    $shortLink = $request->file('upload_sound_link')->store('SoundsFile');
                    $fullLink = url('/') . '/storage/' . $shortLink;
                    $statusClass = 'uploaded_sound';
                }
            } else {
                if (!empty($sound->upload_sound_link)) {
                    $shortLink = $sound->short_upload_sound_link;
                    $fullLink = $sound->upload_sound_link;
                    $statusClass = $sound->sound_class;
                } else {
                    $shortLink = '';
                    $fullLink = '';
                    $statusClass = 'uploaded_sound';
                }
            }
        }

        /// upload image
        if ($request->hasFile('sound_image')) {
            if (!empty($sound->sound_image)) {
                Storage::delete($sound->sound_image);
                $image_path = $request->file('sound_image')->store('SoundImages');
            } else {
                $image_path = $request->file('sound_image')->store('SoundImages');
            }
        } else {
            if (!empty($sound->sound_image)) {
                $image_path = $sound->sound_image;
            } else {
                $image_path = '';
            }
        }


        if (setting()->site_lang_en == 'on') {
            ////////////////////////////////////////////////////////////////////
            /// Youtube
            if ($request->input('sound_class') == 'youtube') {
                $sound->update([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $statusClass,
                    'youtube_link' => $fullLink,
                    'vimeo_link' => null,
                    'upload_sound_link' => null,
                    'short_youtube_link' => $shortLink,
                    'short_vimeo_link' => null,
                    'short_upload_sound_link' => null,
                    'language' => 'ar_en',
                ]);
                ////////////////////////////////////////////////////////////////////
                /// vimeo
            } else if ($request->input('sound_class') == 'vimeo') {
                $sound->update([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $statusClass,
                    'youtube_link' => null,
                    'vimeo_link' => $fullLink,
                    'upload_sound_link' => null,
                    'short_youtube_link' => null,
                    'short_vimeo_link' => $shortLink,
                    'short_upload_sound_link' => null,
                    'language' => 'ar_en',
                    ]);
                ////////////////////////////////////////////////////////////////////
                /// Uploaded Video
            } else {
                $sound->update([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $statusClass,
                    'youtube_link' => null,
                    'vimeo_link' => null,
                    'upload_sound_link' => $fullLink,
                    'short_youtube_link' => null,
                    'short_vimeo_link' => null,
                    'short_upload_sound_link' => $shortLink,
                    'language' => 'ar_en',
                ]);
            }
        } else {
            ////////////////////////////////////////////////////////////////////
            /// Youtube
            if ($request->input('sound_class') == 'youtube') {
                $sound->update([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $statusClass,
                    'youtube_link' => $fullLink,
                    'vimeo_link' => null,
                    'upload_sound_link' => null,
                    'short_youtube_link' => $shortLink,
                    'short_vimeo_link' => null,
                    'short_upload_sound_link' => null,
                    'language' => 'ar',
                ]);
                ////////////////////////////////////////////////////////////////////
                /// vimeo
            } else if ($request->input('sound_class') == 'vimeo') {
                $sound->update([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $statusClass,
                    'youtube_link' => null,
                    'vimeo_link' => $fullLink,
                    'upload_sound_link' => null,
                    'short_youtube_link' => null,
                    'short_vimeo_link' => $shortLink,
                    'short_upload_sound_link' => null,
                    'language' => 'ar',
                    ]);
                ////////////////////////////////////////////////////////////////////
                /// Uploaded Video
            } else {
                $sound->update([
                    'sound_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'date' => $request->date,
                    'length' => $request->length,
                    'sound_class' => $statusClass,
                    'youtube_link' => null,
                    'vimeo_link' => null,
                    'upload_sound_link' => $fullLink,
                    'short_youtube_link' => null,
                    'short_vimeo_link' => null,
                    'short_upload_sound_link' => $shortLink,
                    'language' => 'ar',
                ]);
            }
        }


        if ($request->has('mawhobs')) {
            MawhobSound::where('sound_id', $sound->id)->delete();
            foreach ($request->input('mawhobs') as $mawhob) {
                $mawhobSound = new MawhobSound();
                $mawhobSound->sound_id = $sound->id;
                $mawhobSound->mawhob_id = $mawhob;
                $mawhobSound->save();
            }
        }
        return $this->returnSuccessMessage(trans('general.update_success_message'));


    }


/////////////////////////////////////////
/// Sound restore
    public function restore(Request $request)
    {
        try {
            if ($request->ajax()) {
                $sound = Sound::onlyTrashed()->find($request->id);
                if (!$sound) {
                    return redirect()->route('admin.not.found');
                }
                $sound->restore();
                return $this->returnSuccessMessage(trans('general.restore_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

/////////////////////////////////////////
/// Sound destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $sound = Sound::find($request->id);
                if (!$sound) {
                    return redirect()->route('admin.not.found');
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Sound
                $mawhobSound = MawhobSound::where('sound_id', $request->id)->get();
                if (!$mawhobSound->isEmpty()) {
                    return $this->returnError([trans('sounds.cannot_be_deleted_because_it_have_mawhobs')], 500);
                }

                $sound->delete();
                return $this->returnSuccessMessage(trans('general.move_to_trash'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

/////////////////////////////////////////
/// Sound force delete
    public function forceDestroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $sound = Sound::onlyTrashed()->find($request->id);
                if (!$sound) {
                    return redirect()->route('admin.not.found');
                }
                if (!empty($sound->sound_image)) {
                    Storage::delete($sound->sound_image);
                }

                if (!empty($sound->short_upload_sound_link)) {
                    Storage::delete($sound->short_upload_sound_link);
                }
                MawhobSound::where('sound_id', $sound->id)->delete();
                $sound->forceDelete();
                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

/////////////////////////////////////////
/// Sound change  status
    public function changeStatus(Request $request)
    {

        try {
            $sound = Sound::find($request->id);
            if ($request->switchStatus == 'false') {
                $sound->status = null;
                $sound->save();
            } else {
                $sound->status = 'on';
                $sound->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }


////////////////////////////////////////////
/// view Sound
    public function viewSound(Request $request)
    {
        if ($request->ajax()) {
            $sound = Sound::find($request->id);
            return $this->returnData('OK', 'data', $sound);
        }
    }
}
