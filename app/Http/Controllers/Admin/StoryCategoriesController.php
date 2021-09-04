<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoryCategoryRequest;
use App\Http\Requests\StoryyCategoryUpdateRequest;
use App\Http\Resources\StoryCategoryResource;
use App\Models\Story;
use App\Models\StoryCategory;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryCategoriesController extends Controller
{
    use GeneralTrait;

    /////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.success_story_categories');
        return view('admin.success-stories.categories.index', compact('title'));
    }

    /////////////////////////////////////////////////////////////////////////
    /// Get Story Categories
    public function getStroyCategories(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }
        $list = StoryCategory::orderByDesc('created_at')->offset($offset)->take($perPage)->get();
        $arr = StoryCategoryResource::collection($list);
        $recordsTotal = StoryCategory::get()->count();
        $recordsFiltered = StoryCategory::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    ////////////////////////////////////////////
    /// create Story Category
    public function create()
    {
        $title = trans('menu.add_new_success_story_category');
        return view('admin.success-stories.categories.create', compact('title'));
    }

    /////////////////////////////////////////////
    /// store Story Category
    public function store(StoryCategoryRequest $request)
    {
        try {
            if ($request->has('category_icon')) {
                $icon_path = $request->file('category_icon')->store('StoryCategories');
            } else {
                $icon_path = '';
            }

            if (setting()->site_lang_en == 'on') {
                StoryCategory::create([
                    'category_icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'language' => 'ar_en',
                ]);
            } else {
                StoryCategory::create([
                    'category_icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'description_ar' => $request->description_ar,
                    'description_en' => null,
                    'language' => 'ar',
                ]);
            }

            return $this->returnSuccessMessage(trans('general.add_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }


    /////////////////////////////////////////
    /// edit Story Category
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $storyCategory = StoryCategory::find($id);
        if (!$storyCategory) {
            return redirect()->route('admin.not.found');
        }
        $title = trans('stories.update_category');
        return view('admin.success-stories.categories.update', compact('title', 'storyCategory'));
    }
    ////////////////////////////////////////////
    /// update Story Category
    public function update(StoryyCategoryUpdateRequest $request)
    {
        try {
            $storyCategory = StoryCategory::find($request->id);

            if ($request->hasFile('category_icon')) {
                if (!empty($storyCategory->category_icon)) {
                    Storage::delete($storyCategory->category_icon);
                    $icon_path = $request->file('category_icon')->store('StoryCategories');
                } else {
                    $icon_path = $request->file('category_icon')->store('StoryCategories');
                }
            } else {
                if (!empty($storyCategory->category_icon)) {
                    $icon_path = $storyCategory->category_icon;
                } else {
                    $icon_path = '';
                }
            }

            if (setting()->site_lang_en == 'on') {
                $storyCategory->update([
                    'category_icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'language' => 'ar_en',
                ]);
            } else {
                $storyCategory->update([
                    'category_icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'description_ar' => $request->description_ar,
                    'description_en' => null,
                    'language' => 'ar',
                ]);
            }
            return $this->returnSuccessMessage(trans('general.update_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// Category Story destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $storyCategory = StoryCategory::find($request->id);
                if (!$storyCategory) {
                    return redirect()->route('admin.not.found');
                }


                ////////////////////////////////////////////////////////////////////////
                /// Check Stories
                $stories = Story::where('story_category_id', $request->id)->get();
                if (!$stories->isEmpty()) {
                    return $this->returnError([trans('stories.cannot_be_deleted_because_it_have_stories')], 500);
                }



                if (!empty($storyCategory->category_icon)) {
                    Storage::delete($storyCategory->category_icon);
                }

                $storyCategory->delete();
                return $this->returnSuccessMessage(trans('general.delete_success_message'));

            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }


    ///////////////////////////////////////////////////////////////
    /// get All Story Category Name
    public function getAllStoryCategoryName(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table("story_categories")
                ->select("id", "name_ar")
                ->where('name_ar', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    /////////////////////////////////////////
    /// Get All Story Categories
    public function getAllStoryCategories()
    {
        $storyCategory = StoryCategory::get();
        return $this->returnData('OK', 'data', $storyCategory);
    }
}
