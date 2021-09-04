<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LectureRequest;
use App\Http\Resources\LectureResource;
use App\Models\Lecture;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class LecturesController extends Controller
{
    use GeneralTrait;

    ///////////////////////////////////////////////////////////////
    /// index
    public function index($id = null)
    {
        if (!$id) {
            return redirect()->route('teacher.not.found');
        }
        $title = trans('courses.lectures');
        return view('admin.courses.lectures.index', compact('title', 'id'));
    }
    ///////////////////////////////////////////////////////////////
    /// Get Courses
    public function getLectures(Request $request,$id = null)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }


        $list = Lecture::orderByDesc('created_at')->where('course_id',$id)
            ->offset($offset)->take($perPage)->get();


        $arr = LectureResource::collection($list);
        $recordsTotal = Lecture::get()->count();
        $recordsFiltered = Lecture::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);

    }

    ///////////////////////////////////////////////////////////////
    /// store Lecture
    public function store(LectureRequest $request)
    {

        $lectures = Lecture::where('lecture_date',$request->lecture_date)->where('lecture_from',$request->lecture_from)
            ->where('lecture_to',$request->lecture_to)->get();

        if($lectures->isEmpty()){
            Lecture::create([
                'course_id' => $request->id,
                'lecture_date' => $request->lecture_date,
                'lecture_from' => $request->lecture_from,
                'lecture_to' => $request->lecture_to,
            ]);
            return $this->returnSuccessMessage(trans('general.add_success_message'));

        }else{
            return $this->returnError(trans('courses.lecture_exists'),500);

        }




    }

    ///////////////////////////////////////////////////////////////
    /// Lecture destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $lecture = Lecture::find($request->id);
                if (!$lecture) {
                    return redirect()->route('teacher.not.found');
                }
                $lecture->delete();
                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ///////////////////////////////////////////////////////////////
    /// change  status
    public function changeStatus(Request $request)
    {

        try {
            $lecture = Lecture::find($request->id);
            if (!$lecture) {
                return redirect()->route('admin.not.found');
            }
            if ($request->switchStatus == 'false') {
                $lecture->status = null;
                $lecture->save();
            } else {
                $lecture->status = 'on';
                $lecture->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
}
