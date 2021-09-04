<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SumerCampRequest;
use App\Http\Requests\SumerCampUpdateRequest;
use App\Http\Resources\SummerCampsResource;
use App\Http\Resources\SummerCampsTrashedResource;
use App\Models\SummerCamp;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
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
                    'language' => 'ar_en',
                ]);
            } else {
                $summerCamp->update([
                    'summer_camp_image' => $image_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' =>  null,
                    'name_ar' => $request->name_ar,
                    'name_en' => null,
                    'short_description_ar' => $request->short_description_ar,
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
}
