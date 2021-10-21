<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherAddCategoryRequest;
use App\Http\Requests\TeacherChangePassword;
use App\Http\Requests\TeacherRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Resources\TeachersResource;
use App\Http\Resources\TeachersTrashedResource;
use App\Models\Course;
use App\Models\Mawhoob_Notification;
use App\Models\Teacher;
use App\Models\Teacher_Category;
use App\Traits\GeneralTrait;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    use GeneralTrait;

    /////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.teachers');
        return view('admin.teachers.index', compact('title'));
    }

    /////////////////////////////////////////
    /// Get teachers
    public function getTeachers(Request $request)
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
            $requestData = ['teacher_full_name'];
            $list = Teacher::withoutTrashed()->orderByDesc('created_at')
                ->where(function ($q) use ($requestData, $searchQuery) {
                    foreach ($requestData as $field)
                        $q->orWhere($field, 'like', "%{$searchQuery}%");
                })->get();
        }else{
            $list = Teacher::withoutTrashed()->orderByDesc('created_at')->offset($offset)->take($perPage)->get();

        }



        $arr = TeachersResource::collection($list);
        $recordsTotal = Teacher::get()->count();
        $recordsFiltered = Teacher::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    /////////////////////////////////////////
    /// Get Trashed Teachers index
    public function trashedTeacher()
    {
        $title = trans('teachers.trashed_teachers');
        return view('admin.teachers.trashed-teachers', compact('title'));
    }
    /////////////////////////////////////////
    /// Get Trashed Teacher
    public function getTrashedTeachers(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }

        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }

        $list = Teacher::onlyTrashed()->orderByDesc('created_at')->offset($offset)->take($perPage)->get();
        $arr = TeachersTrashedResource::collection($list);
        $recordsTotal = Teacher::get()->count();
        $recordsFiltered = Teacher::get()->count();
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
        $title = trans('menu.add_new_teacher');
        return view('admin.teachers.create', compact('title'));
    }

    /////////////////////////////////////////
    ///  store
    public function store(TeacherRequest $request)
    {

        try {

            if ($request->hasFile('teacher_photo')) {
                $photo_path = $request->file('teacher_photo')->store('TeachersPhotos');
            } else {
                $photo_path = '';
            }

            if ($request->hasFile('teacher_cv')) {
                $cv_path = $request->file('teacher_cv')->store('TeachersCV');
            } else {
                $cv_path = '';
            }

            Teacher::create([
                'teacher_photo' => $photo_path,
                'slug_teacher_full_name' => slug($request->teacher_full_name),
                'teacher_full_name' => $request->teacher_full_name,
                'teacher_full_name_en' => $request->teacher_full_name_en,
                'teacher_email' => $request->teacher_email,
                'teacher_bio' => $request->teacher_bio,
                'password' => bcrypt($request->password),
                'teacher_mobile_no' => $request->teacher_mobile_no,
                'teacher_whatsapp_no' => $request->teacher_whatsapp_no,
                'country' => $request->country,
                'teacher_qualification' => $request->teacher_qualification,
                'teacher_cv' => $cv_path,
                'teacher_photos_and_videos_link' => $request->teacher_photos_and_videos_link,
                'teacher_gender' => $request->teacher_gender,
            ]);
            return $this->returnSuccessMessage(trans('general.add_success_message'));
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
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return redirect()->route('admin.not.found');
        }
        $title = trans('teachers.update_teacher');

        return view('admin.teachers.update', compact('title', 'teacher'));
    }

    /////////////////////////////////////////
    ///  store
    public function update(TeacherUpdateRequest $request)
    {

        try {
            $teacher = Teacher::find($request->id);

            if (!$teacher) {
                return redirect()->route('admin.not.found');
            }

            if ($request->hasFile('teacher_photo')) {
                if (!empty($teacher->teacher_photo)) {
                    Storage::delete($teacher->teacher_photo);
                    $photo_path = $request->file('teacher_photo')->store('TeachersPhotos');
                } else {
                    $photo_path = $request->file('teacher_photo')->store('TeachersPhotos');
                }
            } else {
                if (!empty($teacher->teacher_photo)) {
                    $photo_path = $teacher->teacher_photo;
                } else {
                    $photo_path = '';
                }
            }


            if ($request->hasFile('teacher_cv')) {
                if (!empty($teacher->teacher_cv)) {
                    Storage::delete($teacher->teacher_cv);
                    $cv_path = $request->file('teacher_cv')->store('TeachersCV');
                } else {
                    $cv_path = $request->file('teacher_cv')->store('TeachersCV');
                }
            } else {
                if (!empty($teacher->teacher_cv)) {
                    $cv_path = $teacher->teacher_cv;
                } else {
                    $cv_path = '';
                }
            }

            if (!empty($request->input('password'))) {
                $password = bcrypt($request->password);
            } else {
                $password = $teacher->password;
            }

            $teacher->update([
                'teacher_photo' => $photo_path,
                'slug_teacher_full_name' => slug($request->teacher_full_name),
                'teacher_full_name' => $request->teacher_full_name,
                'teacher_full_name_en' => $request->teacher_full_name_en,
                'teacher_bio' => $request->teacher_bio,
                'password' => $password,
                'teacher_mobile_no' => $request->teacher_mobile_no,
                'teacher_whatsapp_no' => $request->teacher_whatsapp_no,
                'country' => $request->country,
                'teacher_qualification' => $request->teacher_qualification,
                'teacher_cv' => $cv_path,
                'teacher_photos_and_videos_link' => $request->teacher_photos_and_videos_link,
                'teacher_gender' => $request->teacher_gender,
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
                $teacher = Teacher::onlyTrashed()->find($request->id);
                if (!$teacher) {
                    return redirect()->route('admin.not.found');
                }
                $teacher->restore();
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
                $teacher = Teacher::find($request->id);
                if (!$teacher) {
                    return redirect()->route('admin.not.found');
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Courses
                $courses = Course::where('teacher_id', $request->id)->get();
                if (!$courses->isEmpty()) {
                    return $this->returnError([trans('teachers.cannot_be_deleted_because_it_have_courses')], 500);
                }

                ////////////////////////////////////////////////////////////////////////
                /// Check Teacher Category
                $teacherCategory = Teacher_Category::where('teacher_id', $request->id)->get();
                if (!$teacherCategory->isEmpty()) {
                    return $this->returnError([trans('teachers.cannot_be_deleted_because_it_belong_to_category')], 500);
                }

                $teacher->delete();
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
                $teacher = Teacher::onlyTrashed()->find($request->id);
                if (!$teacher) {
                    return redirect()->route('admin.not.found');
                }
                if (!empty($teacher->teacher_photo)) {
                    Storage::delete($teacher->teacher_photo);
                }
                if (!empty($teacher->teacher_cv)) {
                    Storage::delete($teacher->teacher_cv);
                }

                $teacher->forceDelete();
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
            $teacher = Teacher::find($request->id);
            if ($request->switchStatus == 'false') {
                $teacher->teacher_freeze = null;
                $teacher->save();
            } else {
                $teacher->teacher_freeze = 'on';
                $teacher->save();
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
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return redirect()->route('admin.not.found');
        }

        $title = trans('teachers.profile');

        $teacherCategories = Teacher_Category::with('category')->where('teacher_id', $teacher->id)->get();
        $courses = Course::where('teacher_id', $id)->get();

        $notifications = Mawhoob_Notification::orderByDesc('id')->where('notify_for', 'teacher')
            ->where('teacher_id', $id)->take(20)->get();

        return view('admin.teachers.profile', compact('title', 'teacher',
            'teacherCategories','courses','notifications'));
    }

    ///////////////////////////////////////
    /// change password
    public function changePassword(TeacherChangePassword $request)
    {

        try {
            $teacher = Teacher::find($request->id);
            if (!$teacher) {
                return redirect()->route('admin.not.found');
            }

            if (!empty($request->input('password'))) {
                $password = bcrypt($request->password);
            } else {
                $password = $teacher->password;
            }

            $teacher->password = $password;
            $teacher->save();

            return $this->returnSuccessMessage(trans('general.change_password_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    //////////////////////////////////////
    /// get All Teacher Categories
    public function getAllTeacherCategories(Request $request)
    {
        $teacherCategories = Teacher_Category::with('category')->where('teacher_id', $request->teacher_id)->get();
        return $this->returnData('OK', 'data', $teacherCategories);

    }

    //////////////////////////////////////
    /// add  Teacher category
    public function addCategory(TeacherAddCategoryRequest $request)
    {

        try {
            $categoryExists = Teacher_Category::where('category_id', $request->category_id)
                ->where('teacher_id', $request->teacher_category_id)->get();

            if ($categoryExists->isEmpty()) {
                Teacher_Category::create([
                    'category_id' => $request->category_id,
                    'teacher_id' => $request->teacher_category_id,
                ]);
                return $this->returnSuccessMessage(trans('general.add_success_message'));
            } else {
                return $this->returnError(trans('teachers.category_exists'), '500');

            }

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    //////////////////////////////////////
    /// delete Teacher category

    public function deleteCategory(Request $request)
    {
        try {
            if ($request->ajax()) {

                $teacherCategory = Teacher_Category::find($request->id);
                if (!$teacherCategory) {
                    return redirect()->route('admin.not.found');
                }
                $teacherCategory->delete();
                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ///////////////////////////////////////////////////////////////
    /// get All Teacher Name
    public function getAllTeacherName(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $requestData = ['teacher_full_name','teacher_full_name_en'];

            $data = DB::table("teachers")
                ->select("id", "teacher_full_name", "teacher_full_name_en")
                    ->where(function ($q) use ($requestData, $search) {
                        foreach ($requestData as $field)
                            $q->orWhere($field, 'like', "%{$search}%");
                    })->where('deleted_at',null)->get();
        }
        return response()->json($data);
    }


    public function show($id)
    {
        $teacher = Teacher::find($id);

        session(['teacher_id' => $teacher->id]);
        session(['teacher_login' => 'login']);

        return redirect()->route('teacher.dashboard');
    }
}

