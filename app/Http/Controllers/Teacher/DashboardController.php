<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Teacher_Category;

class DashboardController extends Controller
{
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
        if(!$teacher){
            return  redirect()->route('teacher.not.found');
        }

        $teacherCategories = Teacher_Category::with('category')
            ->where('teacher_id', teacher()->id())->get();
        $courses = Course::where('teacher_id', teacher()->id())->get();

        $title = trans('menu.teacher_profile');
        return view('teacher.profile.profile', compact('title','teacher',
            'teacherCategories','courses'));

    }
}
