<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MawhobEnrolledProgramRequest;
use App\Http\Requests\ProgramRequest;
use App\Http\Requests\ProgramUpdateRequest;
use App\Http\Resources\MawhobEnrolledProgramResource;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\ProgramTrashedResource;
use App\Models\MawhobEnrollProgram;
use App\Models\Mawhoob_Notification;
use App\Models\Program;
use App\Models\Revenue;
use App\Traits\GeneralTrait;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ProgramsController extends Controller
{
    use GeneralTrait;

    /////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.programs');
        return view('admin.programs.index', compact('title'));
    }
    ////////////////////////////////////////
    /// Get programs
    public function getPrograms(Request $request)
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
            $list = Program::where(function ($q) use ($requestData, $searchQuery) {
                foreach ($requestData as $field)
                    $q->orWhere($field, 'like', "%{$searchQuery}%");
            })->get();

        } elseif (!empty($request->status)) {
            if ($request->status == 'disable') {
                $status_vale = null;
            } else {
                $status_vale = 'on';
            }
            $list = Program::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('status', '=', $status_vale)
                ->get();
        } elseif (!empty($request->date_from) && !empty($request->date_to)) {
            $list = Program::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('date', '>=', $request->date_from)
                ->where('date', '<=', $request->date_to)
                ->get();
        } elseif (!empty($request->date_from)) {
            $list = Program::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('date', '=', $request->date_from)
                ->get();
        } else {
            $list = Program::withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)->get();
        }


        $arr = ProgramResource::collection($list);
        $recordsTotal = Program::get()->count();
        $recordsFiltered = Program::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);

    }


    /////////////////////////////////////////
    /// Get Trashed Programs index
    public function trashedPrograms()
    {
        $title = trans('programs.trashed_programs');
        return view('admin.programs.trashed-programs', compact('title'));
    }

    /////////////////////////////////////////
    /// Get Trashed Programs
    public function getTrashedPrograms(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }
        $list = Program::onlyTrashed()->orderByDesc('created_at')->offset($offset)->take($perPage)->get();
        $arr = ProgramTrashedResource::collection($list);
        $recordsTotal = Program::get()->count();
        $recordsFiltered = Program::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    ////////////////////////////////////////////
    /// create program
    public function create()
    {
        $title = trans('menu.add_new_program');
        return view('admin.programs.create', compact('title'));
    }
    /////////////////////////////////////////////
    /// store Program
    public function store(ProgramRequest $request)
    {

        try {
            if ($request->has('icon')) {
                $icon_path = $request->file('icon')->store('ProgramsIcons');
            } else {
                $icon_path = '';
            }
            if ($request->has('work_plan')) {
                $work_plane_path = $request->file('work_plan')->store('ProgramsWorkPlane');
            } else {
                $work_plane_path = '';
            }


            if (setting()->site_lang_en == 'on') {
                Program::create([
                    'icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'short_description_ar' => $request->short_description_ar,
                    'short_description_en' => $request->short_description_en,
                    'hours' => $request->hours,
                    'work_plan' => $work_plane_path,
                    'date' => $request->date,
                    'price' => $request->price,
                    'language' => 'ar_en',

                ]);
            } else {
                Program::create([
                    'icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'name_ar' => $request->name_ar,
                    'short_description_ar' => $request->short_description_ar,
                    'hours' => $request->hours,
                    'work_plan' => $work_plane_path,
                    'date' => $request->date,
                    'price' => $request->price,
                    'language' => 'ar',
                ]);
            }

            return $this->returnSuccessMessage(trans('general.add_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// edit Program
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $program = Program::find($id);
        if (!$program) {
            return redirect()->route('admin.not.found');
        }
        $title = trans('programs.update_program');
        return view('admin.programs.update', compact('title', 'program'));
    }

    /////////////////////////////////////////////
    /// update Program
    public function update(ProgramUpdateRequest $request)
    {

        try {
            $program = Program::find($request->id);

            if ($request->hasFile('icon')) {
                if (!empty($program->icon)) {
                    Storage::delete($program->icon);
                    $icon_path = $request->file('icon')->store('ProgramsIcons');
                } else {
                    $icon_path = $request->file('icon')->store('ProgramsIcons');
                }
            } else {
                if (!empty($program->icon)) {
                    $icon_path = $program->icon;
                } else {
                    $icon_path = '';
                }
            }

            if ($request->hasFile('work_plan')) {
                if (!empty($program->work_plan)) {
                    Storage::delete($program->work_plan);
                    $work_plan_path = $request->file('work_plan')->store('ProgramsWorkPlane');
                } else {
                    $work_plan_path = $request->file('work_plan')->store('ProgramsWorkPlane');
                }
            } else {
                if (!empty($program->work_plan)) {
                    $work_plan_path = $program->work_plan;
                } else {
                    $work_plan_path = '';
                }
            }

            if (setting()->site_lang_en == 'on') {
                $program->update([
                    'icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'slug_name_en' => slug($request->name_en),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'short_description_ar' => $request->short_description_ar,
                    'short_description_en' => $request->short_description_en,
                    'hours' => $request->hours,
                    'work_plan' => $work_plan_path,
                    'date' => $request->date,
                    'price' => $request->price,
                    'language' => 'ar_en',

                ]);
            } else {
                $program->update([
                    'icon' => $icon_path,
                    'slug_name_ar' => slug($request->name_ar),
                    'name_ar' => $request->name_ar,
                    'short_description_ar' => $request->short_description_ar,
                    'hours' => $request->hours,
                    'work_plan' => $work_plan_path,
                    'date' => $request->date,
                    'price' => $request->price,
                    'language' => 'ar',
                ]);
            }

            return $this->returnSuccessMessage(trans('general.update_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    /// Program restore
    public function restore(Request $request)
    {
        try {
            if ($request->ajax()) {
                $program = Program::onlyTrashed()->find($request->id);
                if (!$program) {
                    return redirect()->route('admin.not.found');
                }
                $program->restore();
                return $this->returnSuccessMessage(trans('general.restore_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
    /////////////////////////////////////////
    /// Program destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $program = Program::find($request->id);
                if (!$program) {
                    return redirect()->route('admin.not.found');
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Enroll Program
                $mawhobEnrollProgram = MawhobEnrollProgram::where('program_id', $request->id)->get();
                if (!$mawhobEnrollProgram->isEmpty()) {
                    return $this->returnError([trans('programs.cannot_be_deleted_because_it_enroll_mawhob')], 500);
                }

                $program->delete();
                return $this->returnSuccessMessage(trans('general.move_to_trash'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
    /////////////////////////////////////////
    /// Program force delete
    public function forceDestroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $program = Program::onlyTrashed()->find($request->id);
                if (!$program) {
                    return redirect()->route('admin.not.found');
                }
                if (!empty($program->icon)) {
                    Storage::delete($program->icon);
                }
                if (!empty($program->work_plan)) {
                    Storage::delete($program->work_plan);
                }

                $program->forceDelete();
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
            $program = Program::find($request->id);
            if ($request->switchStatus == 'false') {
                $program->status = null;
                $program->save();
            } else {
                $program->status = 'on';
                $program->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    /// enrolled List
    public function enrolledList($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $program = Program::find($id);
        $title = trans('programs.enrolled_list');
        return view('admin.programs.enrolled-list.index', compact('title',
            'program', 'id'));
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
            $list = MawhobEnrollProgram::join('mawhobs', 'mawhob_enroll_programs.mawhob_id', '=', 'mawhobs.id')
                ->orderByDesc('mawhob_enroll_programs.created_at')
                ->offset($offset)->take($perPage)
                ->select('mawhob_enroll_programs.id as program_id', 'mawhobs.*', 'mawhob_enroll_programs.*')
                ->where('mawhobs.mawhob_full_name', 'like', "%{$searchQuery}%")
                ->where('program_id', $request->my_program_id)->get();

        } else {
            $list = MawhobEnrollProgram::with('mawhob')->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('program_id', $request->my_program_id)->get();
        }

        $arr = MawhobEnrolledProgramResource::collection($list);
        $recordsTotal = MawhobEnrollProgram::get()->count();
        $recordsFiltered = MawhobEnrollProgram::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }
    /////////////////////////////////////////
    /// Destroy Mawhob from Program
    public function DestroyMawhobFromProgram(Request $request)
    {

        try {
            if ($request->ajax()) {
                $mawhobEnrollProgram = MawhobEnrollProgram::find($request->id);

                if (!$mawhobEnrollProgram) {
                    return redirect()->route('admin.not.found');
                }
                $mowhobID = $mawhobEnrollProgram->mawhob_id;
                $programID = $mawhobEnrollProgram->program_id;

                $revenue = Revenue::where('mawhob_id', $mowhobID)->where('revenue_for', $programID)
                    ->where('details', 'enroll_program')->first();
                $revenue->delete();
                $mawhobEnrollProgram->delete();

                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    ////////////////////////////////////////
    /// store new programs mawhob in enrolled list
    public function storeNewProgramMawhob(MawhobEnrolledProgramRequest $request)
    {

        $MawhobEnrollProgram = MawhobEnrollProgram::
        where('program_id', $request->id)
            ->where('mawhob_id', $request->mawhob_id)->get();

        if ($MawhobEnrollProgram->isEmpty()) {

            $mawhobEnrollProgram =  MawhobEnrollProgram::create([
                'program_id' => $request->id,
                'mawhob_id' => $request->mawhob_id,
                'enrolled_date' => Carbon::now()->format('Y-m-d'),
            ]);


            ///////////////////////////////////////////////////////
            /// add  Revenue
            $programPrice = Program::find($request->id)->price;
            Revenue::create([
                'mawhob_id' => $request->mawhob_id,
                'date' => Carbon::now()->format('Y-m-d'),
                'value' => $programPrice,
                'revenue_for' => $request->id,
                'details' => 'enroll_program',
            ]);


            ////////////////////////////////////////////////////
            ///   enrolled program admin notification
            Mawhoob_Notification::create([
                'title_ar' => 'تنبيه التسجيل في برنامج',
                'title_en' => 'Enrolled In Program Notification',

                'details_ar' => ' قام الطالب   ' . $mawhobEnrollProgram->mawhob->mawhob_full_name
                    . ' بالتسجيل في البرنامج التالي   ' . $mawhobEnrollProgram->program->name_ar,

                'details_en' => ' The student   ' . $mawhobEnrollProgram->mawhob->mawhob_full_name
                    . ' Enrolled In This Program   ' . $mawhobEnrollProgram->program->name_en,
                'notify_status' => 'send',
                'notify_class' => 'unread',
                'notify_for' => 'admin',
            ]);

            ////////////////////////////////////////////////////
            ///   enrolled program admin notification
            Mawhoob_Notification::create([
                'title_ar' => 'تنبيه التسجيل في برنامج',
                'title_en' => 'Enrolled In Program Notification',

                'details_ar' => ' قمت  بالتسجيل في البرنامج التالي ' . $mawhobEnrollProgram->program->name_ar,

                'details_en' => ' You   Enrolled In This Program  ' . $mawhobEnrollProgram->program->name_en,
                'notify_status' => 'send',
                'notify_class' => 'unread',
                'notify_for' => 'mawhob',
                'student_id'=> student()->id(),
            ]);


            return $this->returnSuccessMessage(trans('programs.add_new_mawhob_success_message'));
        } else {
            return $this->returnError(trans('programs.mawhob_enrolled_in_this_program'), 500);
        }


    }


}
