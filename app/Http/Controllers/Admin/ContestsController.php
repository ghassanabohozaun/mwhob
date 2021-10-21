<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChooseContestMawhobRequest;
use App\Http\Requests\ContestRenew;
use App\Http\Requests\ContestRequest;
use App\Http\Requests\ContestUpdateRequest;
use App\Http\Requests\MawhobEnrolledContestRequest;
use App\Http\Resources\ContestResource;
use App\Http\Resources\ContestTrashedResource;
use App\Http\Resources\MawhobEnrolledContestResource;
use App\Models\Contest;
use App\Models\MawhobEnrolledContest;
use App\Models\Mawhoob_Notification;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContestsController extends Controller
{

    use GeneralTrait;

    /////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.contests');
        return view('admin.contests.index', compact('title'));
    }


    ////////////////////////////////////////
    /// Get Contests
    public function getContests(Request $request)
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
            $list = Contest::where(function ($q) use ($requestData, $searchQuery) {
                foreach ($requestData as $field)
                    $q->orWhere($field, 'like', "%{$searchQuery}%");
            })->get();
        } elseif (!empty($request->status)) {
            if ($request->status == 'disable') {
                $status_vale = null;
            } else {
                $status_vale = 'on';
            }
            $list = Contest::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('status', '=', $status_vale)
                ->get();

        } elseif (!empty($request->date_from) && !empty($request->date_to)) {
            $list = Contest::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->whereDate('created_at', '>=', $request->date_from)
                ->whereDate('created_at', '<=', $request->date_to)
                ->get();
        } elseif (!empty($request->date_from)) {
            $list = Contest::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->whereDate('created_at', '=', $request->date_from)
                ->get();
        } else {
            $list = Contest::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)->get();
        }

        $arr = ContestResource::collection($list);
        $recordsTotal = Contest::get()->count();
        $recordsFiltered = Contest::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    /////////////////////////////////////////
    /// Get Trashed Contests index
    public function trashedContests()
    {
        $title = trans('contests.trashed_contests');
        return view('admin.contests.trashed-contests', compact('title'));
    }

    ////////////////////////////////////////
    ///  Get Trashed Contests
    public function getTrashedContests(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }

        $list = Contest::onlyTrashed()->orderByDesc('created_at')
            ->offset($offset)->take($perPage)->get();
        $arr = ContestTrashedResource::collection($list);
        $recordsTotal = Contest::get()->count();
        $recordsFiltered = Contest::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }


    ////////////////////////////////////////////
    /// create contest
    public function create()
    {
        $title = trans('menu.add_new_contest');
        return view('admin.contests.create', compact('title'));
    }

    /////////////////////////////////////////////
    /// store contest
    public function store(ContestRequest $request)
    {
        try {

            if ($request->has('contest_image')) {
                $image_path = $request->file('contest_image')->store('Contests');
            } else {
                $image_path = '';
            }

            if (setting()->site_lang_en == 'on') {
                Contest::create([
                    'contest_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'short_description_ar' => $request->short_description_ar,
                    'short_description_en' => $request->short_description_en,
                    'end_date' => $request->end_date,
                    'prize' => $request->prize,
                    'language' => 'ar_en',
                ]);
            } else {
                Contest::create([
                    'contest_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'short_description_ar' => $request->short_description_ar,
                    'short_description_en' => null,
                    'end_date' => $request->end_date,
                    'prize' => $request->prize,
                    'language' => 'ar',
                ]);
            }

            return $this->returnSuccessMessage(trans('general.add_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    /// edit contest
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $contest = Contest::find($id);
        if (!$contest) {
            return redirect()->route('admin.not.found');
        }
        $title = trans('contests.update_contest');
        return view('admin.contests.update', compact('title', 'contest'));
    }
    /////////////////////////////////////////////
    /// update contest
    public function update(ContestUpdateRequest $request)
    {
        try {

            $contest = Contest::find($request->id);
            if (!$contest) {
                return redirect()->route('admin.not.found');
            }

            if ($request->hasFile('contest_image')) {
                if (!empty($contest->contest_image)) {
                    Storage::delete($contest->contest_image);
                    $image_path = $request->file('contest_image')->store('Contests');
                } else {
                    $image_path = $request->file('contest_image')->store('Contests');
                }
            } else {
                if (!empty($contest->contest_image)) {
                    $image_path = $contest->contest_image;
                } else {
                    $image_path = '';
                }
            }


            if (setting()->site_lang_en == 'on') {
                $contest->update([
                    'contest_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'short_description_ar' => $request->short_description_ar,
                    'short_description_en' => $request->short_description_en,
                    'end_date' => $request->end_date,
                    'prize' => $request->prize,
                    'language' => 'ar_en',
                ]);
            } else {
                $contest->update([
                    'contest_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'short_description_ar' => $request->short_description_ar,
                    'short_description_en' => null,
                    'end_date' => $request->end_date,
                    'prize' => $request->prize,
                    'language' => 'ar',
                ]);
            }

            return $this->returnSuccessMessage(trans('general.update_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    /// Contest restore
    public function restore(Request $request)
    {
        try {
            if ($request->ajax()) {
                $contest = Contest::onlyTrashed()->find($request->id);
                if (!$contest) {
                    return redirect()->route('admin.not.found');
                }
                $contest->restore();
                return $this->returnSuccessMessage(trans('general.restore_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
    /////////////////////////////////////////
    /// Contest destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $contest = Contest::find($request->id);
                if (!$contest) {
                    return redirect()->route('admin.not.found');
                }


                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Enrolled Contest
                $mawhobEnrolledContest = MawhobEnrolledContest::where('contest_id', $request->id)->get();
                if (!$mawhobEnrolledContest->isEmpty()) {
                    return $this->returnError([trans('contests.cannot_be_deleted_because_it_enrolled_by_mawhob')], 500);
                }


                $contest->delete();
                return $this->returnSuccessMessage(trans('general.move_to_trash'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
    /////////////////////////////////////////
    /// Contest force delete
    public function forceDestroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $contest = Contest::onlyTrashed()->find($request->id);
                if (!$contest) {
                    return redirect()->route('admin.not.found');
                }
                if (!empty($contest->contest_image)) {
                    Storage::delete($contest->contest_image);
                }
                $contest->forceDelete();
                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// Contest change  status
    public function changeStatus(Request $request)
    {

        try {
            $contest = Contest::find($request->id);
            if ($request->switchStatus == 'false') {
                $contest->status = null;
                $contest->save();
            } else {
                $contest->status = 'on';
                $contest->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }


    /////////////////////////////////////////
    /// Renew Contest
    public function renewContest(ContestRenew $request)
    {
        $contest = Contest::find($request->id);

        if (!$contest) {
            return redirect()->route('admin.not.found');
        }


        ////////////// Start Copy Photo
        $path_parts = explode('/', $contest->contest_image);
        $file_parts = explode('.', $path_parts[1]);
        $copy_photo = $path_parts[0] . '/' . $file_parts[0] . '_' . time() . '_' . $request->id . '.' . $file_parts[1];
        Storage::copy($contest->contest_image, $copy_photo);
        ////////////// Start Copy Photo

        if (setting()->site_lang_en == 'on') {
            Contest::create([
                'contest_image' => $copy_photo,
                'name_ar' => $contest->name_ar,
                'name_en' => $contest->name_en,
                'short_description_ar' => $contest->short_description_ar,
                'short_description_en' => $contest->short_description_en,
                'end_date' => $request->end_date,
                'prize' => $request->prize,
                'language' => 'ar_en',
            ]);
        } else {
            Contest::create([
                'contest_image' => $copy_photo,
                'name_ar' => $contest->name_ar,
                'name_en' => null,
                'short_description_ar' => $contest->short_description_ar,
                'short_description_en' => null,
                'end_date' => $request->end_date,
                'prize' => $request->prize,
                'language' => 'ar',
            ]);
        }
        return $this->returnSuccessMessage(trans('contests.renew_success_message'));

    }



    /////////////////////////////////////////
    /// enrolled List
    public function enrolledList($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $contest = Contest::find($id);
        $title = trans('contests.enrolled_list');
        return view('admin.contests.enrolled-list.index', compact('title', 'contest', 'id'));
    }

    ////////////////////////////////////////
    /// get Enrolled List
    public function getEnrolledList(Request $request)
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
            $list = MawhobEnrolledContest::join('mawhobs', 'mawhob_enrolled_contests.mawhob_id', '=', 'mawhobs.id')
                ->orderByDesc('mawhob_enrolled_contests.created_at')
                ->offset($offset)->take($perPage)
                ->select('mawhob_enrolled_contests.id as contest_id', 'mawhobs.*', 'mawhob_enrolled_contests.*')
                ->where('mawhobs.mawhob_full_name', 'like', "%{$searchQuery}%")
                ->orWhere('mawhobs.mawhob_full_name_en', 'like', "%{$searchQuery}%")
                ->where('contest_id', $request->my_contest_id)->get();

        } else {
            $list = MawhobEnrolledContest::with('mawhob')->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('contest_id', $request->my_contest_id)->get();

        }


        $arr = MawhobEnrolledContestResource::collection($list);
        $recordsTotal = MawhobEnrolledContest::get()->count();
        $recordsFiltered = MawhobEnrolledContest::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    ////////////////////////////////////////
    /// store new contest mawhob in enrolled list
    public function storeNewContestMawhob(MawhobEnrolledContestRequest $request)
    {

        try {

            $MawhobEnrolledContest = MawhobEnrolledContest::
            where('contest_id', $request->id)
                ->where('mawhob_id', $request->mawhob_id)->get();

            if ($MawhobEnrolledContest->isEmpty()) {

                if (setting()->site_lang_en == 'on') {
                    $mawhobEnrolledContest =  MawhobEnrolledContest::create([
                        'contest_id' => $request->id,
                        'mawhob_id' => $request->mawhob_id,
                        'enrolled_date' => Carbon::now()->format('Y-m-d'),
                        'language' => 'ar_en',
                    ]);
                } else {
                    $mawhobEnrolledContest =   MawhobEnrolledContest::create([
                        'contest_id' => $request->id,
                        'mawhob_id' => $request->mawhob_id,
                        'enrolled_date' => Carbon::now()->format('Y-m-d'),
                        'language' => 'ar',
                    ]);
                }


                ////////////////////////////////////////////////////
                ///   enrolled contest Admin notification
                Mawhoob_Notification::create([
                    'title_ar' => 'تنبيه التسجيل في مسابقة',
                    'title_en' => 'Enrolled In Contest Notification',

                    'details_ar' => ' قام الموهوب   ' . $mawhobEnrolledContest->mawhob->mawhob_full_name
                        . ' بالتسجيل في المسابقة التالية  ' . $mawhobEnrolledContest->contest->name_ar,

                    'details_en' => ' The Mawhoob   ' . $mawhobEnrolledContest->mawhob->mawhob_full_name_en
                        . ' Enrolled In This Contest   ' . $mawhobEnrolledContest->contest->name_en,
                    'notify_status' => 'send',
                    'notify_class' => 'unread',
                    'notify_for' => 'admin',
                ]);


                ////////////////////////////////////////////////////
                ///   enrolled contest student notification
                Mawhoob_Notification::create([
                    'title_ar' => 'تنبيه التسجيل في مسابقة',
                    'title_en' => 'Enrolled In Contest Notification',
                    'details_ar' => ' قمت بالتسجيل في المسابقة التالية  ' . $mawhobEnrolledContest->contest->name_ar,
                    'details_en' => ' You Enrolled In This Contest ' . $mawhobEnrolledContest->contest->name_en,
                    'notify_status' => 'send',
                    'notify_class' => 'unread',
                    'notify_for' => 'mawhob',
                    'student_id' => student()->id(),

                ]);


                return $this->returnSuccessMessage(trans('contests.add_new_mawhob_success_message'));
            } else {
                return $this->returnError(trans('contests.mawhob_enrolled_in_this_contest'), 500);
            }

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ////////////////////////////////////////
    /// Choose Contest Winner
    public function chooseContestWinner(ChooseContestMawhobRequest $request)
    {
        try {
            /// contests itself
            $Contest_by_id = MawhobEnrolledContest::find($request->id);
            // get Contset ID
            $contest_id = $Contest_by_id->contest_id;

            if ($Contest_by_id->mawhob_winner == 'false') {
                $all_mawhobs_in_contest = MawhobEnrolledContest::where('contest_id', $contest_id)->get();

                foreach ($all_mawhobs_in_contest as $mawhob) {
                    $mawhob->update([
                        'mawhob_winner' => 'false',
                        'mawhob_winner_description_ar' => null,
                        'mawhob_winner_description_en' => null,
                    ]);
                }
            }

            $Contest_by_id->update([
                'mawhob_winner' => 'true',
                'mawhob_winner_description_ar' => $request->mawhob_winner_description_ar,
                'mawhob_winner_description_en' => $request->mawhob_winner_description_en,
            ]);

            ////////////////////////////////////////////////////
            ///   enrolled contest student notification
            Mawhoob_Notification::create([
                'title_ar' => 'رسالة تهنئة بالفوز في مسابقة',
                'title_en' => 'Congratulation for winning a contest',
                'details_ar' => ' لقد فزت في المسابقة التالية ' . $Contest_by_id->contest->name_ar .' سوف نتواصل معك في اقرب وقت لاستلام جائزتك ',
                'details_en' => ' You won the following contest  ' .  $Contest_by_id->contest->name_en .' We will contact you as soon as possible to collect your prize ',
                'notify_status' => 'send',
                'notify_class' => 'unread',
                'notify_for' => 'mawhob',
                'student_id' => $Contest_by_id->mawhob_id,
            ]);

            return $this->returnSuccessMessage(trans('contests.winner_of_contest_chosen'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// Destroy Mawhob from Contest
    public function DestroyMawhobFromContest(Request $request)
    {

        try {
            if ($request->ajax()) {
                $mawhobEnrolledContest = MawhobEnrolledContest::find($request->id);

                if (!$mawhobEnrolledContest) {
                    return redirect()->route('admin.not.found');
                }
                if ($mawhobEnrolledContest->mawhob_winner == 'false') {
                    $mawhobEnrolledContest->delete();
                } else {
                    return $this->returnError(trans('contests.cannot_delete_winner'), 500);
                }
                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

}
