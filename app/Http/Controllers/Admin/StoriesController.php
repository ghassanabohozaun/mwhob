<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoryRequest;
use App\Http\Requests\StoryUpdateRequest;
use App\Http\Resources\StoryResource;
use App\Http\Resources\StoryTrashedResource;
use App\Models\MawhobExperience;
use App\Models\Story;
use App\Models\StoryCategory;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoriesController extends Controller
{
    use GeneralTrait;

    /////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.success_stories');
        return view('admin.success-stories.index', compact('title'));
    }

    ////////////////////////////////////////
    /// Get Stories
    public function getStories(Request $request)
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
            $list = Story::join('mawhobs', 'stories.mawhob_id', '=', 'mawhobs.id')
                ->select('stories.id as id', 'stories.*', 'mawhobs.mawhob_full_name')
                ->where('mawhobs.mawhob_full_name', 'like', "%{$searchQuery}%")
                ->orWhere('mawhobs.mawhob_full_name_en', 'like', "%{$searchQuery}%")
                ->get();
        } elseif (!empty($request->status)) {
            if ($request->status == 'disable') {
                $status_vale = null;
            } else {
                $status_vale = 'on';
            }
            $list = Story::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('status', '=', $status_vale)
                ->get();

        } elseif (!empty($request->date_from) && !empty($request->date_to)) {
            $list = Story::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->whereDate('created_at', '>=', $request->date_from)
                ->whereDate('created_at', '<=', $request->date_to)
                ->get();
        } elseif (!empty($request->date_from)) {
            $list = Story::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->whereDate('created_at', '=', $request->date_from)
                ->get();
        } else {
            $list = Story::with('mawhob')->withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)->get();
        }

        $arr = StoryResource::collection($list);
        $recordsTotal = Story::get()->count();
        $recordsFiltered = Story::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    /////////////////////////////////////////
    /// Get Trashed Stories index
    public function trashedStories()
    {
        $title = trans('stories.trashed_stories');
        return view('admin.success-stories.trashed-stories', compact('title'));
    }

    ////////////////////////////////////////
    ///  Get Trashed Stories
    public function getTrashedStories(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }

        $list = Story::onlyTrashed()->orderByDesc('created_at')
            ->offset($offset)->take($perPage)->get();
        $arr = StoryTrashedResource::collection($list);
        $recordsTotal = Story::get()->count();
        $recordsFiltered = Story::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    ////////////////////////////////////////////
    /// create story
    public function create()
    {
        $title = trans('menu.add_new_success_story');
        $storyCategories = StoryCategory::get();
        return view('admin.success-stories.create', compact('title', 'storyCategories'));
    }

    /////////////////////////////////////////////
    /// store story
    public function store(StoryRequest $request)
    {

        try {
            if ($request->has('story_icon')) {
                $icon_path = $request->file('story_icon')->store('StoryIcons');
            } else {
                $icon_path = '';
            }


            if ($request->has('story_image')) {
                $image_path = $request->file('story_image')->store('StoryImages');
            } else {
                $image_path = '';
            }


            if (setting()->site_lang_en == 'on') {
                $story = Story::create([
                    'story_icon' => $icon_path,
                    'story_image' => $image_path,
                    'about_mawhob_ar' => $request->about_mawhob_ar,
                    'about_mawhob_en' => $request->about_mawhob_en,
                    'mawhob_id' => $request->mawhob_id,
                    'story_category_id' => $request->story_category_id,
                    'language' => 'ar_en',
                ]);
            } else {
                $story = Story::create([
                    'story_icon' => $icon_path,
                    'story_image' => $image_path,
                    'about_mawhob_ar' => $request->about_mawhob_ar,
                    'mawhob_id' => $request->mawhob_id,
                    'story_category_id' => $request->story_category_id,
                    'language' => 'ar',
                ]);
            }


            if ($request->has('experience_name_ar') && $request->has('experience_percentage')) {
                $i = 0;
                foreach ($request->input('experience_name_ar') as $text) {
                    $mawhobExperience = new MawhobExperience();
                    $mawhobExperience->story_id = $story->id;
                    $mawhobExperience->mawhob_id = $request->mawhob_id;
                    $mawhobExperience->experience_name_ar = $text;
                    $mawhobExperience->experience_name_en = $request->input('experience_name_en')[$i];;
                    $mawhobExperience->experience_percentage = $request->input('experience_percentage')[$i];
                    $mawhobExperience->save();
                    $i++;
                }
            }


            return $this->returnSuccessMessage(trans('general.add_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    /// edit story
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $story = Story::find($id);
        if (!$story) {
            return redirect()->route('admin.not.found');
        }
        $title = trans('stories.update_story');
        $storyCategories = StoryCategory::get();
        $mawhobExperiences = MawhobExperience::orderBy('id', 'asc')->where('story_id', $id)->get();

        return view('admin.success-stories.update', compact('title', 'story',
            'storyCategories', 'mawhobExperiences'));
    }
    /////////////////////////////////////////////
    /// update story
    public function update(StoryUpdateRequest $request)
    {
        try {

            $story = Story::find($request->id);
            if (!$story) {
                return redirect()->route('admin.not.found');
            }

            if ($request->hasFile('story_icon')) {
                if (!empty($story->story_icon)) {
                    Storage::delete($story->story_icon);
                    $icon_path = $request->file('story_icon')->store('StoryIcons');
                } else {
                    $icon_path = $request->file('story_icon')->store('StoryIcons');
                }
            } else {
                if (!empty($story->story_icon)) {
                    $icon_path = $story->story_icon;
                } else {
                    $icon_path = '';
                }
            }


            if ($request->hasFile('story_image')) {
                if (!empty($story->story_image)) {
                    Storage::delete($story->story_image);
                    $image_path = $request->file('story_image')->store('StoryImages');
                } else {
                    $image_path = $request->file('story_image')->store('StoryImages');
                }
            } else {
                if (!empty($story->story_image)) {
                    $image_path = $story->story_image;
                } else {
                    $image_path = '';
                }
            }


            if (setting()->site_lang_en == 'on') {
                $story->update([
                    'story_icon' => $icon_path,
                    'story_image' => $image_path,
                    'about_mawhob_ar' => $request->about_mawhob_ar,
                    'about_mawhob_en' => $request->about_mawhob_en,
                    'mawhob_id' => $request->mawhob_id,
                    'story_category_id' => $request->story_category_id,
                    'language' => 'ar_en',
                ]);
            } else {
                $story->update([
                    'story_icon' => $icon_path,
                    'story_image' => $image_path,
                    'about_mawhob_ar' => $request->about_mawhob_ar,
                    'mawhob_id' => $request->mawhob_id,
                    'story_category_id' => $request->story_category_id,
                    'language' => 'ar',
                ]);
            }


            /////////////////////////////////////////////////////////////////////////
            ///  Mawhob Experience
            MawhobExperience::where('story_id', $request->id)->delete();
            if ($request->has('experience_name_ar') && $request->has('experience_percentage')) {
                $i = 0;
                foreach ($request->input('experience_name_ar') as $text) {
                    $mawhobExperience = new MawhobExperience();
                    $mawhobExperience->story_id = $story->id;
                    $mawhobExperience->mawhob_id = $request->mawhob_id;
                    $mawhobExperience->experience_name_ar = $text;
                    $mawhobExperience->experience_name_en = $request->input('experience_name_en')[$i];;
                    $mawhobExperience->experience_percentage = $request->input('experience_percentage')[$i];
                    $mawhobExperience->save();
                    $i++;
                }
            }


            return $this->returnSuccessMessage(trans('general.update_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    /// Story restore
    public function restore(Request $request)
    {
        try {
            if ($request->ajax()) {
                $story = Story::onlyTrashed()->find($request->id);
                if (!$story) {
                    return redirect()->route('admin.not.found');
                }
                $story->restore();
                return $this->returnSuccessMessage(trans('general.restore_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
    /////////////////////////////////////////
    /// Story destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $story = Story::find($request->id);
                if (!$story) {
                    return redirect()->route('admin.not.found');
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Experience
                $mawhobExperience = MawhobExperience::where('story_id', $request->id)->get();
                if (!$mawhobExperience->isEmpty()) {
                    return $this->returnError([trans('stories.cannot_be_deleted_because_it_have_mawhob_experience')], 500);
                }


                $story->delete();
                return $this->returnSuccessMessage(trans('general.move_to_trash'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
    /////////////////////////////////////////
    /// Story force delete
    public function forceDestroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $story = Story::onlyTrashed()->find($request->id);
                if (!$story) {
                    return redirect()->route('admin.not.found');
                }
                if (!empty($story->story_icon)) {
                    Storage::delete($story->story_icon);
                }
                if (!empty($story->story_image)) {
                    Storage::delete($story->story_image);
                }

                MawhobExperience::where('story_id', $request->id)->delete();

                $story->forceDelete();
                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// Story change  status
    public function changeStatus(Request $request)
    {
        try {
            $story = Story::find($request->id);
            if ($request->switchStatus == 'false') {
                $story->status = null;
                $story->save();
            } else {
                $story->status = 'on';
                $story->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }


    ///////////////////////////////////////////////////////////////
    /// show Story Details
    public function showStoryDetails(Request $request)
    {
        if ($request->ajax()) {
            $story = Story::with('mawhob')->with('storyCategory')->find($request->id);
            if (!$story) {
                return redirect()->route('admin.not.found');
            }
            return $this->returnData('OK', 'data', $story);
        }
    }


    public function getAllMawhobExperiences(Request $request)
    {
        if ($request->ajax()) {
            $mawhobExperience = MawhobExperience::where('story_id', $request->story_id)->get();
            return response()->json($mawhobExperience);
        }
    }
}
