<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MawhobEnrolledSummerCampRequest;
use App\Http\Requests\SumerCampRequest;
use App\Http\Requests\SumerCampUpdateRequest;
use App\Http\Resources\MawhobEnrolledSummerCampResource;
use App\Http\Resources\SummerCampsResource;
use App\Http\Resources\SummerCampsTrashedResource;
use App\Models\MawhobEnrollSummerCamp;
use App\Models\Mawhoob_Notification;
use App\Models\Revenue;
use App\Models\SummerCamp;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class SummerCampsController extends Controller
{
    use GeneralTrait;

    /////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.summer_camps');
        return view('admin.summer-camps.index', compact('title'));
    }

    ////////////////////////////////////////
    /// Get Summer Camps
    public function getSummerCamps(Request $request)
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
            $list = SummerCamp::where(function ($q) use ($requestData, $searchQuery) {
                foreach ($requestData as $field)
                    $q->orWhere($field, 'like', "%{$searchQuery}%");
            })->get();

        } elseif (!empty($request->status)) {
            if ($request->status == 'disable') {
                $status_vale = null;
            } else {
                $status_vale = 'on';
            }
            $list = SummerCamp::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('status', '=', $status_vale)
                ->get();
        } elseif (!empty($request->date_from) && !empty($request->date_to)) {
            $list = SummerCamp::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->whereDate('created_at', '>=', $request->date_from)
                ->whereDate('created_at', '<=', $request->date_to)
                ->get();
        } elseif (!empty($request->date_from)) {
            $list = SummerCamp::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->whereDate('created_at', '=', $request->date_from)
                ->get();

        } else {
            $list = SummerCamp::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)->get();
        }


        $arr = SummerCampsResource::collection($list);
        $recordsTotal = SummerCamp::get()->count();
        $recordsFiltered = SummerCamp::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }


    /////////////////////////////////////////
    /// Get Trashed Summer Camps index
    public function trashedSummerCamps()
    {
        $title = trans('summerCamps.trashed_summer_camps');
        return view('admin.summer-camps.trashed-summer-camps', compact('title'));
    }

    /////////////////////////////////////////
    /// Get Trashed Summer Camps
    public function getTrashedSummerCamps(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }
        $list = SummerCamp::onlyTrashed()->orderByDesc('created_at')->offset($offset)->take($perPage)->get();
        $arr = SummerCampsTrashedResource::collection($list);
        $recordsTotal = SummerCamp::get()->count();
        $recordsFiltered = SummerCamp::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }


    ////////////////////////////////////////////
    /// create Summer Camp
    public function create()
    {
        $title = trans('menu.add_new_summer_camp');
        return view('admin.summer-camps.create', compact('title'));
    }

    /////////////////////////////////////////////
    /// store Summer Camp
    public function store(SumerCampRequest $request)
    {
        try {

            if ($request->has('summer_camp_image')) {
                $image_path = $request->file('summer_camp_image')->store('SummerCamps');
            } else {
                $image_path = '';
            }

            if (setting()->site_lang_en == 'on') {
                SummerCamp::create([
                    'summer_camp_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'short_description_ar' => $request->short_description_ar,
                    'short_description_en' => $request->short_description_en,
                    'year' => $request->year ,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'cost' => $request->cost,
                    'discount' => $request->discount,
                    'language' => 'ar_en',
                ]);
            } else {
                SummerCamp::create([
                    'summer_camp_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'short_description_ar' => $request->short_description_ar,
                    'short_description_en' => null,
                    'year' => $request->year ,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'cost' => $request->cost,
                    'discount' => $request->discount,
                    'language' => 'ar',
                ]);
            }

            return $this->returnSuccessMessage(trans('general.add_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    /// edit Summer Camp
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $summerCamp = SummerCamp::find($id);
        if (!$summerCamp) {
            return redirect()->route('admin.not.found');
        }
        $title = trans('summerCamps.update_summer_camp');
        return view('admin.summer-camps.update', compact('title', 'summerCamp'));
    }
    /////////////////////////////////////////////
    /// update Summer Camp
    public function update(SumerCampUpdateRequest $request)
    {
        try {

            $summerCamp = SummerCamp::find($request->id);
            if (!$summerCamp) {
                return redirect()->route('admin.not.found');
            }

            if ($request->hasFile('summer_camp_image')) {
                if (!empty($summerCamp->summer_camp_image)) {
                    Storage::delete($summerCamp->summer_camp_image);
                    $image_path = $request->file('summer_camp_image')->store('SummerCamps');
                } else {
                    $image_path = $request->file('summer_camp_image')->store('SummerCamps');
                }
            } else {
                if (!empty($summerCamp->summer_camp_image)) {
                    $image_path = $summerCamp->summer_camp_image;
                } else {
                    $image_path = '';
                }
            }


            if (setting()->site_lang_en == 'on') {
                $summerCamp->update([
                    'summer_camp_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'short_description_ar' => $request->short_description_ar,
                    'short_description_en' => $request->short_description_en,
                    'year' => $request->year ,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'cost' => $request->cost,
                    'discount' => $request->discount,
                    'language' => 'ar_en',
                ]);
            } else {
                $summerCamp->update([
                    'summer_camp_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'short_description_ar' => $request->short_description_ar,
                    'year' => $request->year ,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'cost' => $request->cost,
                    'discount' => $request->discount,
                    'short_description_en' => null,
                    'language' => 'ar',
                ]);
            }

            return $this->returnSuccessMessage(trans('general.update_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    /// Summer Camp restore
    public function restore(Request $request)
    {
        try {
            if ($request->ajax()) {
                $summerCamp = SummerCamp::onlyTrashed()->find($request->id);
                if (!$summerCamp) {
                    return redirect()->route('admin.not.found');
                }
                $summerCamp->restore();
                return $this->returnSuccessMessage(trans('general.restore_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
    /////////////////////////////////////////
    /// Summer Camp destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $summerCamp = SummerCamp::find($request->id);
                if (!$summerCamp) {
                    return redirect()->route('admin.not.found');
                }
                $summerCamp->delete();
                return $this->returnSuccessMessage(trans('general.move_to_trash'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// Summer Camp force delete
    public function forceDestroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $summerCamp = SummerCamp::onlyTrashed()->find($request->id);
                if (!$summerCamp) {
                    return redirect()->route('admin.not.found');
                }
                if (!empty($summerCamp->summer_camp_image)) {
                    Storage::delete($summerCamp->summer_camp_image);
                }
                $summerCamp->forceDelete();
                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// Summer Camp change  status
    public function changeStatus(Request $request)
    {

        try {
            $summerCamp = SummerCamp::find($request->id);
            if ($request->switchStatus == 'false') {
                $summerCamp->status = null;
                $summerCamp->save();
            } else {
                $summerCamp->status = 'on';
                $summerCamp->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// Summer Camp Enable Enrolling
    public function enableEnrolling(Request $request)
    {
        try {
            $summerCamp = SummerCamp::find($request->id);
            if ($request->enableEnrollingStatus == 'false') {
                $summerCamp->enable_enrolling = null;
                $summerCamp->save();
            } else {
                $summerCamp->enable_enrolling = 'on';
                $summerCamp->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }


    ///////////////////////////////////////////////////////////////
    /// show Course Details
    public function showSummerCampDetails(Request $request)
    {
        if ($request->ajax()) {
            $summerCamp = SummerCamp::find($request->id);
            if (!$summerCamp) {
                return redirect()->route('admin.not.found');
            }
            return $this->returnData('OK', 'data', $summerCamp);
        }
    }


    /////////////////////////////////////////
    /// enrolled List
    public function enrolledList($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $summerCamp = SummerCamp::find($id);
        $title = trans('summerCamps.enrolled_list');
        return view('admin.summer-camps.enrolled-list.index', compact('title',
            'summerCamp', 'id'));
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

            $list = MawhobEnrollSummerCamp::join('mawhobs', 'mawhob_enroll_summer_camps.mawhob_id', '=', 'mawhobs.id')
                ->orderByDesc('mawhob_enroll_summer_camps.created_at')
                ->offset($offset)->take($perPage)
                ->select('mawhob_enroll_summer_camps.id as summer_camp_id', 'mawhobs.*', 'mawhob_enroll_summer_camps.*')
                ->where('mawhobs.mawhob_full_name', 'like', "%{$searchQuery}%")
                ->orWhere('mawhobs.mawhob_full_name_en', 'like', "%{$searchQuery}%")
                ->where('summer_camp_id', $request->my_summer_camp_id)->get();

        } else {
            $list = MawhobEnrollSummerCamp::with('mawhob')->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('summer_camp_id', $request->my_summer_camp_id)->get();
        }

        $arr = MawhobEnrolledSummerCampResource::collection($list);
        $recordsTotal = MawhobEnrollSummerCamp::get()->count();
        $recordsFiltered = MawhobEnrollSummerCamp::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }
    /////////////////////////////////////////
    /// Destroy Mawhob from summer Camp
    public function DestroyMawhobFromSummerCamp(Request $request)
    {

        try {
            if ($request->ajax()) {
                $mawhobEnrollSummerCamp = MawhobEnrollSummerCamp::find($request->id);

                if (!$mawhobEnrollSummerCamp) {
                    return redirect()->route('admin.not.found');
                }
                $mowhobID = $mawhobEnrollSummerCamp->mawhob_id;
                $summerCampID = $mawhobEnrollSummerCamp->summer_camp_id;

                $revenue = Revenue::where('mawhob_id', $mowhobID)->where('revenue_for', $summerCampID)
                    ->where('details', 'enroll_summer_camp')->first();
                $revenue->delete();
                $mawhobEnrollSummerCamp->delete();

                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    ////////////////////////////////////////
    /// store new summer camp mawhob in enrolled list
    public function storeNewSummerCampMawhob(MawhobEnrolledSummerCampRequest $request)
    {

        $MawhobEnrollSummerCamp = MawhobEnrollSummerCamp::where('summer_camp_id', $request->id)
            ->where('mawhob_id', $request->mawhob_id)->get();

        if ($MawhobEnrollSummerCamp->isEmpty()) {

            $mawhobEnrollSummerCamp = MawhobEnrollSummerCamp::create([
                'summer_camp_id' => $request->id,
                'mawhob_id' => $request->mawhob_id,
                'enrolled_date' => Carbon::now()->format('Y-m-d'),
            ]);


            ///////////////////////////////////////////////////////
            /// add  Revenue
            $summerCampPrice = SummerCamp::find($request->id)->price;
            $summerCampDiscount = SummerCamp::find($request->id)->discount;

            if ($summerCampDiscount == '' || $summerCampDiscount == 0) {
                $value = $summerCampPrice;
            } else {
                $value = $summerCampDiscount;
            }

            Revenue::create([
                'mawhob_id' => $request->mawhob_id,
                'date' => Carbon::now()->format('Y-m-d'),
                'value' => $value,
                'revenue_for' => $request->id,
                'details' => 'enroll_summer_camp',
                'payment_method'=>'dashboard',
            ]);

            ////////////////////////////////////////////////////
            ///   enrolled summer camp admin notification
            Mawhoob_Notification::create([
                'title_ar' => 'تنبيه التسجيل في مخيم صيفي',
                'title_en' => 'Enrolled In Summer Camp Notification',

                'details_ar' => ' قام الموهوب   ' . $mawhobEnrollSummerCamp->mawhob->mawhob_full_name
                    . ' بالتسجيل في المخيم الصيفي التالي   ' . $mawhobEnrollSummerCamp->summerCamp->name_ar,

                'details_en' => ' The Mawhoob   ' . $mawhobEnrollSummerCamp->mawhob->mawhob_full_name_en
                    . ' Enrolled In This Summer Camp   ' . $mawhobEnrollSummerCamp->summerCamp->name_en,
                'notify_status' => 'send',
                'notify_class' => 'unread',
                'notify_for' => 'admin',
            ]);

            ////////////////////////////////////////////////////
            ///   enrolled summer camp admin notification
            Mawhoob_Notification::create([
                'title_ar' => 'تنبيه التسجيل في مخيم صيفي',
                'title_en' => 'Enrolled In Summer Camp Notification',

                'details_ar' => ' قمت  بالتسجيل في المخيم الصيفي التالي ' . $mawhobEnrollSummerCamp->summerCamp->name_ar,

                'details_en' => ' You   Enrolled In This Summer Camp  ' . $mawhobEnrollSummerCamp->summerCamp->name_en,
                'notify_status' => 'send',
                'notify_class' => 'unread',
                'notify_for' => 'mawhob',
                'student_id' => student()->id(),
            ]);


            return $this->returnSuccessMessage(trans('summerCamps.add_new_mawhob_success_message'));
        } else {
            return $this->returnError(trans('summerCamps.mawhob_enrolled_in_this_summer_camp'), 500);
        }


    }

}
