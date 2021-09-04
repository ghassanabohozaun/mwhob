<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Teacher_Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use GeneralTrait;

    ////////////////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('dashboard.teacher_panel');
        /*if(session()->has('teacher_id')){
           $teacher =  Teacher::find(session()->get('teacher_id')) ;
        }else{
            $teacher =  Teacher::find(Auth::guard('teacher')->id()) ;
        }*/
        return view('teacher.dashboard', compact('title'));
    }


    ////////////////////////////////////////////////////////
    /// not Found
    public function notFound()
    {
        $title = trans('general.not_found');
        return view('teacher.errors.not-found', compact('title'));
    }


    public function profile()
    {

        $teacher = Teacher::find(teacher()->id());
        if (!$teacher) {
            return redirect()->route('teacher.not.found');
        }

        $teacherCategories = Teacher_Category::with('category')
            ->where('teacher_id', teacher()->id())->get();
        $courses = Course::where('teacher_id', teacher()->id())->get();

        $title = trans('menu.teacher_profile');
        return view('teacher.profile.profile', compact('title', 'teacher',
            'teacherCategories', 'courses'));

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
}
