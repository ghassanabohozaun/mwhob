<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MowhobRequest;
use App\Http\Requests\MowhobUpdateRequest;
use App\Http\Resources\MowhobsResource;
use App\Http\Resources\MowhobsTrashedResource;
use App\Models\BestMawhob;
use App\Models\Category;
use App\Models\Mawhob;
use App\Models\MawhobEnrollCourse;
use App\Models\MawhobEnrolledContest;
use App\Models\MawhobEnrollProgram;
use App\Models\MawhobExperience;
use App\Models\MawhobSound;
use App\Models\MawhobVideo;
use App\Models\Revenue;
use App\Models\Story;
use App\Traits\GeneralTrait;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MowhobsController extends Controller
{
    use GeneralTrait;

    /////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.mowhobs');
        $categories = Category::get();
        return view('admin.mowhobs.index', compact('title', 'categories'));
    }
    /////////////////////////////////////////
    /// Get Mowhobs
    public function getMowhobs(Request $request)
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
            $requestData = ['mawhob_full_name','mawhob_full_name_en'];

            $list = Mawhob::with('category')
                ->withoutTrashed()->orderByDesc('created_at')
                ->where(function ($q) use ($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                })->get();
        } elseif (!empty($request->status)) {
            if ($request->status == 'active') {
                $status_value = 'on';
            } else {
                $status_value = null;
            }
            $list = $list = Mawhob::with('category')
                ->withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('freeze', '=', $status_value)
                ->get();

        } elseif (!empty($request->category_id)) {
            $categoryID = $request->category_id;

            $list = $list = Mawhob::with('category')
                ->withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('category_id', '=', $categoryID)
                ->get();
        } else {
            $list = Mawhob::with('category')->withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)->get();
        }


        $arr = MowhobsResource::collection($list);
        $recordsTotal = Mawhob::get()->count();
        $recordsFiltered = Mawhob::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    /////////////////////////////////////////
    /// Get Trashed mowhobs index
    public function trashedMowhob()
    {
        $title = trans('mowhob.trashed_mowhobs');
        return view('admin.mowhobs.trashed-mowhobs', compact('title'));
    }
    /////////////////////////////////////////
    /// Get Trashed mowhobs
    public function getTrashedMowhobs(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }

        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }

        $list = Mawhob::onlyTrashed()->with('category')->orderByDesc('created_at')->offset($offset)->take($perPage)->get();
        $arr = MowhobsTrashedResource::collection($list);
        $recordsTotal = Mawhob::get()->count();
        $recordsFiltered = Mawhob::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }
    ///////////////////////////////////////////
    /// create
    public function create()
    {
        $title = trans('menu.add_new_mowhob');
        $categories = Category::get();
        return view('admin.mowhobs.create', compact('title', 'categories'));
    }
    /////////////////////////////////////////
    ///  store
    public function store(MowhobRequest $request)
    {


        try {

            $mawhoobExists = Mawhob::where('mawhob_mobile_no', $request->mawhob_mobile_no)->first();

            if (!$mawhoobExists) {

                if ($request->hasFile('photo')) {
                    $photo_path = $request->file('photo')->store('Mowhobs');
                } else {
                    $photo_path = '';
                }

                Mawhob::create([
                    'photo' => $photo_path,
                    'slug_mawhob_full_name' => slug($request->mawhob_full_name),
                    'mawhob_full_name' => $request->mawhob_full_name,
                    'mawhob_full_name_en' => $request->mawhob_full_name_en,
                    'mawhob_mobile_no' => $request->mawhob_mobile_no,
                    'password' => '$2y$10$J1uHls/Pp690G8aJslCgDelNYeC3YRVsyc.h4GHxFDrr2U6L6wUF2',
                    'mawhob_whatsapp_no' => $request->mawhob_whatsapp_no,
                    'mawhob_birthday' => $request->mawhob_birthday,
                    'mowhob_gender' => $request->mowhob_gender,
                    'category_id' => $request->category_id,
                    'portfolio' => $request->portfolio,

                ]);
                return $this->returnSuccessMessage(trans('general.add_success_message'));
            } else {
                return $this->returnError(trans('mowhob.mawhob_exists'), 500);
            }

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
    /////////////////////////////////////////
    /// edit
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $mowhob = Mawhob::find($id);
        if (!$mowhob) {
            return redirect()->route('admin.not.found');
        }
        $categories = Category::get();
        $title = trans('mowhob.update_mowhob');

        return view('admin.mowhobs.update', compact('title', 'mowhob', 'categories'));
    }
    /////////////////////////////////////////
    ///  update
    public function update(MowhobUpdateRequest $request)
    {

        try {

            $mowhob = Mawhob::find($request->id);

            if ($request->hasFile('photo')) {
                if (!empty($mowhob->photo)) {
                    Storage::delete($mowhob->photo);
                    $photo_path = $request->file('photo')->store('Mowhobs');
                } else {
                    $photo_path = $request->file('photo')->store('Mowhobs');
                }
            } else {
                if (!empty($mowhob->photo)) {
                    $photo_path = $mowhob->photo;
                } else {
                    $photo_path = '';
                }
            }
            $mowhob->update([
                'photo' => $photo_path,
                'slug_mawhob_full_name' => slug($request->mawhob_full_name),
                'mawhob_full_name' => $request->mawhob_full_name,
                'mawhob_full_name_en' => $request->mawhob_full_name_en,
                'password' => '$2y$10$J1uHls/Pp690G8aJslCgDelNYeC3YRVsyc.h4GHxFDrr2U6L6wUF2',
                'mawhob_whatsapp_no' => $request->mawhob_whatsapp_no,
                'mawhob_birthday' => $request->mawhob_birthday,
                'mowhob_gender' => $request->mowhob_gender,
                'category_id' => $request->category_id,
                'portfolio' => $request->portfolio,
            ]);
            return $this->returnSuccessMessage(trans('general.update_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    ///  restore
    public function restore(Request $request)
    {
        try {
            if ($request->ajax()) {
                $mowhob = Mawhob::onlyTrashed()->find($request->id);
                if (!$mowhob) {
                    return redirect()->route('admin.not.found');
                }
                $mowhob->restore();
                return $this->returnSuccessMessage(trans('general.restore_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
    /////////////////////////////////////////
    ///  Destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $mowhob = Mawhob::find($request->id);
                if (!$mowhob) {
                    return redirect()->route('admin.not.found');
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Story
                $stories = Story::where('mawhob_id', $request->id)->get();
                if (!$stories->isEmpty()) {
                    return $this->returnError([trans('mowhob.cannot_be_deleted_because_it_have_stories')], 500);
                }
                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Sound
                $mawhobSound = MawhobSound::where('mawhob_id', $request->id)->get();
                if (!$mawhobSound->isEmpty()) {
                    return $this->returnError([trans('mowhob.cannot_be_deleted_because_it_have_sounds')], 500);
                }
                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Video
                $mawhobVideo = MawhobVideo::where('mawhob_id', $request->id)->get();
                if (!$mawhobVideo->isEmpty()) {
                    return $this->returnError([trans('mowhob.cannot_be_deleted_because_it_have_videos')], 500);
                }
                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Enrolled Contest
                $mawhobEnrolledContest = MawhobEnrolledContest::where('mawhob_id', $request->id)->get();
                if (!$mawhobEnrolledContest->isEmpty()) {
                    return $this->returnError([trans('mowhob.cannot_be_deleted_because_it_have_contest')], 500);
                }
                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Experience
                $mawhobExperience = MawhobExperience::where('mawhob_id', $request->id)->get();
                if (!$mawhobExperience->isEmpty()) {
                    return $this->returnError([trans('mowhob.cannot_be_deleted_because_it_have_experience')], 500);
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Best Mawhob
                $bestMawhob = BestMawhob::where('mawhob_id', $request->id)->get();
                if (!$bestMawhob->isEmpty()) {
                    return $this->returnError([trans('mowhob.cannot_be_deleted_because_it_has_best_mawhob')], 500);
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Enrolled Course
                $mawhobEnrollCourse = MawhobEnrollCourse::where('mawhob_id', $request->id)->get();
                if (!$mawhobEnrollCourse->isEmpty()) {
                    return $this->returnError([trans('mowhob.cannot_be_deleted_because_it_have_course')], 500);
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Enrolled Program
                $mawhobEnrollProgram = MawhobEnrollProgram::where('mawhob_id', $request->id)->get();
                if (!$mawhobEnrollProgram->isEmpty()) {
                    return $this->returnError([trans('mowhob.cannot_be_deleted_because_it_have_program')], 500);
                }
                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Revenue
                $mawhobRevenues = Revenue::where('mawhob_id', $request->id)->get();
                if (!$mawhobRevenues->isEmpty()) {
                    return $this->returnError([trans('mowhob.cannot_be_deleted_because_it_have_revenues')], 500);
                }


                $mowhob->delete();
                return $this->returnSuccessMessage(trans('general.move_to_trash'));
            }

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    ///  force delete
    public function forceDelete(Request $request)
    {
        try {
            if ($request->ajax()) {
                $mowhob = Mawhob::onlyTrashed()->find($request->id);
                if (!$mowhob) {
                    return redirect()->route('admin.not.found');
                }
                if (!empty($mowhob->photo)) {
                    Storage::delete($mowhob->photo);
                }
                $mowhob->forceDelete();

                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    /// change  status
    public function changeStatus(Request $request)
    {
        try {
            $mowhob = Mawhob::find($request->id);
            if ($request->switchStatus == 'false') {
                $mowhob->freeze = null;
                $mowhob->save();
            } else {
                $mowhob->freeze = 'on';
                $mowhob->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    ///////////////////////////////////////
    /// profile
    public function profile($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $mowhob = Mawhob::find($id);
        if (!$mowhob) {
            return redirect()->route('admin.not.found');
        }

        $title = trans('mowhob.profile');


        $mawhobEnrolledContests = MawhobEnrolledContest:: with('contest')->where('mawhob_id', $id)->get();

        $mawhobEnrollCourses = MawhobEnrollCourse::with('course')->where('mawhob_id', $id)->get();
        $mawhobEnrollPrograms = MawhobEnrollProgram::with('program')->where('mawhob_id', $id)->get();


        return view('admin.mowhobs.profile', compact('title', 'mowhob',
            'mawhobEnrolledContests', 'mawhobEnrollCourses', 'mawhobEnrollPrograms'));
    }


    ///////////////////////////////////////////////////////////////
    /// get All Mowhobs Name
    public function getAllMowhobName(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $requestData = ['mawhob_full_name','mawhob_full_name_en'];
            $data = DB::table("mawhobs")
                ->select("id", "mawhob_full_name",'mawhob_full_name_en')
                ->where(function ($q) use ($requestData, $search) {
                    foreach ($requestData as $field)
                        $q->orWhere($field, 'like', "%{$search}%");
                })->get();
        }
        return response()->json($data);
    }

}
