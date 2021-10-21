<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherCourseRequest;
use App\Http\Requests\Teacher\TeacherCourseUpdateRequest;
use App\Http\Resources\teachers\TeacherCourseResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\Mawhoob_Notification;
use App\Models\Teacher;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    use GeneralTrait;

    ///////////////////////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.courses');
        $categories = Category::get();
        return view('teacher.courses.index', compact('title', 'categories'));
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


        if (!empty($request->date_from) && !empty($request->date_to)) {
            $list = Course::with('category')->with('teacher')
                ->withoutTrashed()->orderByDesc('created_at')
                ->whereDate('created_at', '>=', $request->date_from)
                ->whereDate('created_at', '<=', $request->date_to)
                ->where('teacher_id', auth()->guard('teacher')->id())
                ->offset($offset)->take($perPage)->get();
        } else if (!empty($request->date_from)) {
            $list = Course::with('category')->with('teacher')
                ->withoutTrashed()->orderByDesc('created_at')
                ->whereDate('created_at', '=', $request->date_from)
                ->where('teacher_id', auth()->guard('teacher')->id())
                ->offset($offset)->take($perPage)->get();

        } else if (!empty($request->category_id)) {
            $serach_value = $request->category_id;
            $list = $list = Course::with('category')->with('teacher')
                ->withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('teacher_id', auth()->guard('teacher')->id())
                ->where('category_id', '=', $serach_value)
                ->get();
        } elseif (!empty($request->active)) {
            if ($request->active == 'disable') {
                $active_value = null;
            } else {
                $active_value = 'on';
            }
            $list = $list = Course::with('category')->with('teacher')
                ->withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('teacher_id', auth()->guard('teacher')->id())
                ->where('active', '=', $active_value)
                ->get();
        } else {
            $list = Course::with('category')->with('teacher')
                ->withoutTrashed()->orderByDesc('created_at')
                ->offset($offset)->take($perPage)
                ->where('teacher_id', auth()->guard('teacher')->id())
                ->get();
        }


        $arr = TeacherCourseResource::collection($list);
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
        return view('teacher.courses.create', compact('title', 'categories'));
    }

    ///////////////////////////////////////////////////////////////
    /// store Course
    public function store(TeacherCourseRequest $request)
    {

        try {
            if ($request->has('course_image')) {
                $course_image_path = $request->file('course_image')->store('Courses');
            } else {
                $course_image_path = '';
            }

            if (setting()->site_lang_en == 'on') {
                $course = Course::create([
                    'course_image' => $course_image_path,
                    'slug_title_ar' => slug($request->title_ar),
                    'slug_title_en' => slug($request->title_en),
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'hours' => $request->hours,
                    'cost' => $request->cost,
                    'discount' => null,
                    'category_id' => $request->category_id,
                    'teacher_id' => teacher()->id(),
                    'zoom_link' => $request->zoom_link,
                    'language' => 'ar_en',
                ]);
            } else {
                $course = Course::create([
                    'course_image' => $course_image_path,
                    'slug_title_ar' => slug($request->title_ar),
                    'title_ar' => $request->title_ar,
                    'description_ar' => $request->description_ar,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'hours' => $request->hours,
                    'cost' => $request->cost,
                    'discount' => null,
                    'category_id' => $request->category_id,
                    'teacher_id' => teacher()->id(),
                    'zoom_link' => $request->zoom_link,
                    'language' => 'ar',
                ]);
            }


            $teacher = Teacher::find(teacher()->id());
            ////////////////////////////////////////////////////
            ///  new course added notification
            Mawhoob_Notification::create([
                'title_ar' => 'تنبيه اضافة دورة جديدة',
                'title_en' => 'Added New Course Notification',
                'details_ar' => ' قام المدرس ' . $teacher->teacher_full_name . ' باضافة دورة جديدة بعنوان ' . $course->title_ar,
                'details_en' => ' The teacher  ' . $teacher->teacher_full_name . ' Add New Course Named ' . $course->title_en,
                'notify_status' => 'send',
                'notify_class' => 'unread',
                'notify_for' => 'admin',
            ]);

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
            return redirect()->route('teacher.not.found');
        }
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('teacher.not.found');
        }

        $title = trans('courses.update_course');
        $categories = Category::get();
        return view('teacher.courses.update', compact('title', 'course', 'categories'));
    }

    ///////////////////////////////////////////////////////////////
    /// update Course
    public function update(TeacherCourseUpdateRequest $request)
    {

        try {
            $course = Course::find($request->id);
            if (!$course) {
                return redirect()->route('teacher.not.found');
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
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'hours' => $request->hours,
                    'cost' => $request->cost,
                    'discount' => null,
                    'category_id' => $request->category_id,
                    'teacher_id' => teacher()->id(),
                    'zoom_link' => $request->zoom_link,
                    'language' => 'ar_en',
                ]);
            } else {
                $course->update([
                    'course_image' => $course_image_path,
                    'slug_title_ar' => slug($request->title_ar),
                    'title_ar' => $request->title_ar,
                    'description_ar' => $request->description_ar,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'hours' => $request->hours,
                    'cost' => $request->cost,
                    'discount' => null,
                    'category_id' => $request->category_id,
                    'teacher_id' => teacher()->id(),
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
    /// change  status
    public function changeStatus(Request $request)
    {

        try {
            $course = Course::find($request->id);
            if (!$course) {
                return redirect()->route('teacher.not.found');
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
                return redirect()->route('teacher.not.found');
            }
            if ($request->switchActive == 'false') {
                $course->active = null;
                $course->save();
            } else {
                $course->active = 'on';
                $course->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

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
                return redirect()->route('teacher.not.found');
            }
            return $this->returnData('OK', 'data', $course);
        }
    }


}
