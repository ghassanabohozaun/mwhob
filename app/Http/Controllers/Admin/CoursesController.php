<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseChangeTeacherRequest;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Requests\MawhobEnrolledCourseRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseTrashedResource;
use App\Http\Resources\MawhobEnrolledCourseResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\MawhobEnrollCourse;
use App\Models\Mawhoob_Notification;
use App\Models\Revenue;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    use GeneralTrait;

    ///////////////////////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.courses');
        return view('admin.courses.index', compact('title'));
    }
    ///////////////////////////////////////////////////////////////
    /// Get Courses
    public function getCourses(Request $request)
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
            $requestData = ['title_ar', 'title_en'];
            $list = Course::with('category')->with('teacher')
                ->withoutTrashed()->orderByDesc('created_at')
                ->where(function ($q) use ($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                })->get();
        } elseif (!empty($request->date_from) && !empty($request->date_to)) {
            $list = Course::with('category')->with('teacher')
                ->withoutTrashed()->orderByDesc('created_at')
                ->whereDate('created_at', '>=', $request->date_from)
                ->whereDate('created_at', '<=', $request->date_to)
                ->offset($offset)->take($perPage)->get();
        } elseif (!empty($request->date_from)) {
            $list = Course::with('category')->with('teacher')
                ->withoutTrashed()->orderByDesc('created_at')
                ->whereDate('created_at', '=', $request->date_from)
                ->offset($offset)->take($perPage)->get();
        } elseif (!empty($request->status)) {
            if ($request->status == 'disable') {
                $status_vale = null;
            } else {
                $status_vale = 'on';
            }
            $list = $list = Course::with('category')->with('teacher')
                ->withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('status', '=', $status_vale)
                ->get();
        } else {
            $list = Course::with('category')->with('teacher')
                ->withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)->get();
        }


        $arr = CourseResource::collection($list);
        $recordsTotal = Course::get()->count();
        $recordsFiltered = Course::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);

    }

    ///////////////////////////////////////////////////////////////
    /// Get Trashed Course index
    public function trashedCourses()
    {
        $title = trans('courses.trashed_courses');
        return view('admin.courses.trashed-courses', compact('title'));
    }

    ///////////////////////////////////////////////////////////////
    /// Get Trashed courses
    public function getTrashedCourses(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }
        $list = Course::onlyTrashed()->orderByDesc('created_at')->offset($offset)->take($perPage)->get();
        $arr = CourseTrashedResource::collection($list);
        $recordsTotal = Course::get()->count();
        $recordsFiltered = Course::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    ///////////////////////////////////////////////////////////////
    /// create course
    public function create()
    {
        $title = trans('menu.add_new_course');
        $categories = Category::get();
        return view('admin.courses.create', compact('title', 'categories'));
    }

    ///////////////////////////////////////////////////////////////
    /// store Course
    public function store(CourseRequest $request)
    {

        try {
            if ($request->has('course_image')) {
                $course_image_path = $request->file('course_image')->store('Courses');
            } else {
                $course_image_path = '';
            }

            if (setting()->site_lang_en == 'on') {
                Course::create([
                    'course_image' => $course_image_path,
                    'slug_title_ar' => slug($request->title_ar),
                    'slug_title_en' => slug($request->title_en),
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'hours' => $request->hours,
                    'cost' => $request->cost,
                    'discount' => $request->discount,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'category_id' => $request->category_id,
                    'teacher_id' => $request->teacher_id,
                    'zoom_link' => $request->zoom_link,
                    'language' => 'ar_en',

                ]);
            } else {
                Course::create([
                    'course_image' => $course_image_path,
                    'slug_title_ar' => slug($request->title_ar),
                    'title_ar' => $request->title_ar,
                    'description_ar' => $request->description_ar,
                    'hours' => $request->hours,
                    'cost' => $request->cost,
                    'discount' => $request->discount,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'category_id' => $request->category_id,
                    'teacher_id' => $request->teacher_id,
                    'zoom_link' => $request->zoom_link,
                    'language' => 'ar',
                ]);
            }
            return $this->returnSuccessMessage(trans('general.add_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ///////////////////////////////////////////////////////////////
    /// edit Course
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('admin.not.found');
        }

        $title = trans('courses.update_course');
        $categories = Category::get();
        return view('admin.courses.update', compact('title', 'course', 'categories'));
    }

    ///////////////////////////////////////////////////////////////
    /// update Course
    public function update(CourseUpdateRequest $request)
    {

        try {
            $course = Course::find($request->id);
            if (!$course) {
                return redirect()->route('admin.not.found');
            }

            if ($request->hasFile('course_image')) {
                if (!empty($course->course_image)) {
                    Storage::delete($course->course_image);
                    $course_image_path = $request->file('course_image')->store('Courses');
                } else {
                    $course_image_path = $request->file('course_image')->store('Courses');
                }
            } else {
                if (!empty($course->course_image)) {
                    $course_image_path = $course->course_image;
                } else {
                    $course_image_path = '';
                }
            }


            if (setting()->site_lang_en == 'on') {
                $course->update([
                    'course_image' => $course_image_path,
                    'slug_title_ar' => slug($request->title_ar),
                    'slug_title_en' => slug($request->title_en),
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'hours' => $request->hours,
                    'cost' => $request->cost,
                    'discount' => $request->discount,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'category_id' => $request->category_id,
                    'teacher_id' => $request->teacher_id,
                    'zoom_link' => $request->zoom_link,
                    'language' => 'ar_en',
                ]);
            } else {
                $course->update([
                    'course_image' => $course_image_path,
                    'slug_title_ar' => slug($request->title_ar),
                    'title_ar' => $request->title_ar,
                    'description_ar' => $request->description_ar,
                    'hours' => $request->hours,
                    'cost' => $request->cost,
                    'discount' => $request->discount,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'category_id' => $request->category_id,
                    'teacher_id' => $request->teacher_id,
                    'zoom_link' => $request->zoom_link,
                    'language' => 'ar',
                ]);
            }
            return $this->returnSuccessMessage(trans('general.update_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ///////////////////////////////////////////////////////////////
    /// Course restore
    public function restore(Request $request)
    {
        try {
            if ($request->ajax()) {
                $course = Course::onlyTrashed()->find($request->id);
                if (!$course) {
                    return redirect()->route('admin.not.found');
                }
                $course->restore();
                return $this->returnSuccessMessage(trans('general.restore_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ///////////////////////////////////////////////////////////////
    /// Course destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $course = Course::find($request->id);
                if (!$course) {
                    return redirect()->route('admin.not.found');
                }


                ////////////////////////////////////////////////////////////////////////
                /// Check lectures
                $lectures = Lecture::where('course_id', $request->id)->get();
                if (!$lectures->isEmpty()) {
                    return $this->returnError([trans('courses.cannot_be_deleted_because_it_have_lectures')], 500);
                }
                ////////////////////////////////////////////////////////////////////////
                /// Check Mawhob Enroll Course
                $mawhobEnrollCourse = MawhobEnrollCourse::where('course_id', $request->id)->get();
                if (!$mawhobEnrollCourse->isEmpty()) {
                    return $this->returnError([trans('courses.cannot_be_deleted_because_it_enrolled_by_mawhob')], 500);
                }


                $course->delete();
                return $this->returnSuccessMessage(trans('general.move_to_trash'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ///////////////////////////////////////////////////////////////
    /// Course force delete
    public function forceDestroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $course = Course::onlyTrashed()->find($request->id);
                if (!$course) {
                    return redirect()->route('admin.not.found');
                }
                if (!empty($course->course_image)) {
                    Storage::delete($course->course_image);
                }
                $course->forceDelete();
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
            $course = Course::find($request->id);
            if (!$course) {
                return redirect()->route('admin.not.found');
            }
            if ($request->switchStatus == 'false') {
                $course->status = null;
                $course->save();
            } else {
                $course->status = 'on';
                $course->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ///////////////////////////////////////////////////////////////
    /// change active
    public function changeActive(Request $request)
    {

        try {
            $course = Course::find($request->id);
            if (!$course) {
                return redirect()->route('admin.not.found');
            }
            if ($request->switchActive == 'false') {
                $course->active = null;
                $course->save();

                ////////////////////////////////////////////////////
                ///  active Course notification
                Mawhoob_Notification::create([
                    'title_ar' => 'تنبيه الغاء تفعيل  دورة ',
                    'title_en' => 'canceling activation of a course',
                    'details_ar' => ' تمت الغاء تفعيل دورتك التالية  ' . $course->title_ar,
                    'details_en' => ' canceling active of your course  ' . $course->title_en,
                    'notify_status' => 'send',
                    'notify_class' => 'unread',
                    'notify_for' => 'teacher',
                    'teacher_id' => $course->teacher_id,
                ]);


            } else {
                $course->active = 'on';
                $course->save();
                ////////////////////////////////////////////////////
                ///  active Course notification
                Mawhoob_Notification::create([
                    'title_ar' => 'تنبيه الموافقة علي دورة وتفعليها ',
                    'title_en' => 'Approve And Activate course Notification',
                    'details_ar' => ' تمت الموافقة وتفعيل دورتك التالية  ' . $course->title_ar,
                    'details_en' => ' Approve and active your course  ' . $course->title_en,
                    'notify_status' => 'send',
                    'notify_class' => 'unread',
                    'notify_for' => 'teacher',
                    'teacher_id' => $course->teacher_id,
                ]);
            }


            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ///////////////////////////////////////////////////////////////
    ///change Teacher Of Course
    public function changeTeacherOfCourse(CourseChangeTeacherRequest $request)
    {
        try {
            if ($request->ajax()) {
                $course = Course::find($request->id);
                if (!$course) {
                    return redirect()->route('admin.not.found');
                }
                $course->teacher_id = $request->teacher_id;
                $course->save();
                return $this->returnSuccessMessage(trans('courses.change_course_teacher_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    ///////////////////////////////////////////////////////////////
    /// show Course Details
    public function showCourseDetails(Request $request)
    {
        if ($request->ajax()) {
            $course = Course::with('category')->with('teacher')->find($request->id);
            if (!$course) {
                return redirect()->route('admin.not.found');
            }
            return $this->returnData('OK', 'data', $course);
        }
    }



    /////////////////////////////////////////
    /// enrolled List
    public function enrolledList($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $course = Course::find($id);
        $title = trans('courses.enrolled_list');
        return view('admin.courses.enrolled-list.index', compact('title', 'course', 'id'));
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

            $list = MawhobEnrollCourse::join('mawhobs', 'mawhob_enroll_courses.mawhob_id', '=', 'mawhobs.id')
                ->orderByDesc('mawhob_enroll_courses.created_at')
                ->offset($offset)->take($perPage)
                ->select('mawhob_enroll_courses.id as course_id', 'mawhobs.*', 'mawhob_enroll_courses.*')
                ->where('mawhobs.mawhob_full_name', 'like', "%{$searchQuery}%")
                ->orWhere('mawhobs.mawhob_full_name_en', 'like', "%{$searchQuery}%")
                ->where('course_id', $request->my_course_id)->get();

        } else {
            $list = MawhobEnrollCourse::with('mawhob')->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('course_id', $request->my_course_id)->get();
        }

        $arr = MawhobEnrolledCourseResource::collection($list);
        $recordsTotal = MawhobEnrollCourse::get()->count();
        $recordsFiltered = MawhobEnrollCourse::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }
    /////////////////////////////////////////
    /// Destroy Mawhob from Course
    public function DestroyMawhobFromCourse(Request $request)
    {

        try {
            if ($request->ajax()) {
                $mawhobEnrollCourse = MawhobEnrollCourse::find($request->id);

                if (!$mawhobEnrollCourse) {
                    return redirect()->route('admin.not.found');
                }
                $mowhobID = $mawhobEnrollCourse->mawhob_id;
                $courseID = $mawhobEnrollCourse->course_id;

                $revenue = Revenue::where('mawhob_id', $mowhobID)->where('revenue_for', $courseID)
                    ->where('details', 'enroll_course')->first();
                $revenue->delete();
                $mawhobEnrollCourse->delete();

                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    ////////////////////////////////////////
    /// store new course mawhob in enrolled list
    public function storeNewCourseMawhob(MawhobEnrolledCourseRequest $request)
    {

        $MawhobEnrollCourse = MawhobEnrollCourse::
        where('course_id', $request->id)->where('mawhob_id', $request->mawhob_id)->get();

        if ($MawhobEnrollCourse->isEmpty()) {

            $mawhobEnrollCourse = MawhobEnrollCourse::create([
                'course_id' => $request->id,
                'mawhob_id' => $request->mawhob_id,
                'enrolled_date' => Carbon::now()->format('Y-m-d'),
            ]);


            ///////////////////////////////////////////////////////
            /// add  Revenue
            $coureCost = Course::find($request->id)->cost;

            $coureDiscount = Course::find($request->id)->discount;

            if ($coureDiscount == '' || $coureDiscount == 0) {
                $value = $coureCost;
            } else {
                $value = $coureDiscount;
            }

            Revenue::create([
                'mawhob_id' => $request->mawhob_id,
                'date' => Carbon::now()->format('Y-m-d'),
                'value' => $value,
                'revenue_for' => $request->id,
                'details' => 'enroll_course',
            ]);
            ////////////////////////////////////////////////////
            ///   enrolled course Admin notification
            Mawhoob_Notification::create([
                'title_ar' => 'تنبيه التسجيل في دورة',
                'title_en' => 'Enrolled In Course Notification',

                'details_ar' => ' قام الموهوب   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name
                    . ' بالتسجيل في الدورة التالية  ' . $mawhobEnrollCourse->course->title_ar,

                'details_en' => ' The Mawhoob   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name_en
                    . ' Enrolled In This Course   ' . $mawhobEnrollCourse->course->title_en,
                'notify_status' => 'send',
                'notify_class' => 'unread',
                'notify_for' => 'admin',
            ]);


            ////////////////////////////////////////////////////
            ///  student enrolled course  Teacher notification
            Mawhoob_Notification::create([
                'title_ar' => 'تنبيه التسجيل في دورة',
                'title_en' => 'Enrolled In Course Notification',

                'details_ar' => ' قام الموهوب   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name
                    . ' بالتسجيل في دورتك التالية  ' . $mawhobEnrollCourse->course->title_ar,

                'details_en' => ' The Mawhoob   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name_en
                    . ' Enrolled In Your Course   ' . $mawhobEnrollCourse->course->title_en,
                'notify_status' => 'send',
                'notify_class' => 'unread',
                'notify_for' => 'teacher',
                'teacher_id' => $mawhobEnrollCourse->course->teacher_id,
            ]);


            ////////////////////////////////////////////////////
            ///  student enrolled course  student notification
            Mawhoob_Notification::create([
                'title_ar' => 'تنبيه التسجيل في دورة',
                'title_en' => 'Enrolled In Course Notification',

                'details_ar' => ' قمت بالتسجيل في الدورة التالية ' . $mawhobEnrollCourse->course->title_ar,

                'details_en' => ' You Enrolled In This Course  ' . $mawhobEnrollCourse->course->title_en,
                'notify_status' => 'send',
                'notify_class' => 'unread',
                'notify_for' => 'mawhob',
                'student_id' => student()->id(),
            ]);

            return $this->returnSuccessMessage(trans('courses.add_new_mawhob_success_message'));
        } else {
            return $this->returnError(trans('courses.mawhob_enrolled_in_this_course'), 500);
        }


    }

}
