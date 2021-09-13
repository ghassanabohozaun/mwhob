<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\MawhobEnrollCourse;
use App\Models\MawhobEnrolledContest;
use App\Models\MawhobEnrollProgram;
use App\Models\Mawhoob_Notification;
use App\Models\Program;
use App\Models\Revenue;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use GeneralTrait;

    ///////////////////////////////////////////////////
    /// Student Enroll Contest
    public function enrollContest(Request $request)
    {
        if ($request->ajax()) {

            $MawhobEnrolledContest = MawhobEnrolledContest::
            where('contest_id', $request->contest_id)
                ->where('mawhob_id', $request->mawhob_id)->get();

            if ($MawhobEnrolledContest->isEmpty()) {

                ////////////////////////////////////////////////////////////////////
                ///// enroll contest
                $mawhobEnrolledContest = MawhobEnrolledContest::create([
                    'contest_id' => $request->contest_id,
                    'mawhob_id' => $request->mawhob_id,
                    'enrolled_date' => Carbon::now()->format('Y-m-d'),
                ]);

                ////////////////////////////////////////////////////
                ///   enrolled contest Admin notification
                Mawhoob_Notification::create([
                    'title_ar' => 'تنبيه التسجيل في مسابقة',
                    'title_en' => 'Enrolled In Contest Notification',

                    'details_ar' => ' قام الطالب   ' . $mawhobEnrolledContest->mawhob->mawhob_full_name
                        . ' بالتسجيل في المسابقة التالية  ' . $mawhobEnrolledContest->contest->name_ar,

                    'details_en' => ' The student   ' . $mawhobEnrolledContest->mawhob->mawhob_full_name
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


                return $this->returnSuccessMessage(trans('site.enrolled_in_contest_successfully'));
            } else {
                return $this->returnError(trans('site.already_enrolled_in_this_contest'), 500);
            }
        }
    }


    ///////////////////////////////////////////////////
    /// Student Enroll Course
    public function enrollCourse(Request $request)
    {

        if ($request->ajax()) {

            $MawhobEnrollCourse = MawhobEnrollCourse::
            where('course_id', $request->course_id)
                ->where('mawhob_id', $request->mawhob_id)->get();

            if ($MawhobEnrollCourse->isEmpty()) {
                ////////////////////////////////////////////////////////////////////
                ///// enroll Course
                $mawhobEnrollCourse = MawhobEnrollCourse::create([
                    'course_id' => $request->course_id,
                    'mawhob_id' => $request->mawhob_id,
                    'enrolled_date' => Carbon::now()->format('Y-m-d'),
                ]);

                ////////////////////////////////////////////////////////////////////
                ///// Course Revenue
                $coureCost = Course::find($request->course_id)->cost;
                $coureDiscount = Course::find($request->course_id)->discount;
                if ($coureDiscount == '' || $coureDiscount == 0) {
                    $value = $coureCost;
                } else {
                    $value = $coureDiscount;
                }
                Revenue::create([
                    'mawhob_id' => $request->mawhob_id,
                    'date' => Carbon::now()->format('Y-m-d'),
                    'value' => $value,
                    'revenue_for' => $request->course_id,
                    'details' => 'enroll_course',
                ]);

                ////////////////////////////////////////////////////
                ///   enrolled course Admin notification
                Mawhoob_Notification::create([
                    'title_ar' => 'تنبيه التسجيل في دورة',
                    'title_en' => 'Enrolled In Course Notification',

                    'details_ar' => ' قام الطالب   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name
                        . ' بالتسجيل في الدورة التالية  ' . $mawhobEnrollCourse->course->title_ar,

                    'details_en' => ' The student   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name
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

                    'details_ar' => ' قام الطالب   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name
                        . ' بالتسجيل في دورتك التالية  ' . $mawhobEnrollCourse->course->title_ar,

                    'details_en' => ' The student   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name
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


                return $this->returnSuccessMessage(trans('site.enrolled_in_course_successfully'));
            } else {
                return $this->returnError(trans('site.already_enrolled_in_this_course'), 500);
            }
        }
    }


    ///////////////////////////////////////////////////
    /// Student Enroll Program
    public function enrollProgram(Request $request)
    {

        if ($request->ajax()) {

            $MawhobEnrollProgram = MawhobEnrollProgram::
            where('program_id', $request->program_id)
                ->where('mawhob_id', $request->mawhob_id)->get();

            if ($MawhobEnrollProgram->isEmpty()) {
                ////////////////////////////////////////////////////////////////////
                ///// enroll program
                $mawhobEnrollProgram = MawhobEnrollProgram::create([
                    'program_id' => $request->program_id,
                    'mawhob_id' => $request->mawhob_id,
                    'enrolled_date' => Carbon::now()->format('Y-m-d'),
                ]);

                ////////////////////////////////////////////////////////////////////
                ///// add Revenue
                $courePrice = Program::find($request->program_id)->price;
                Revenue::create([
                    'mawhob_id' => $request->mawhob_id,
                    'date' => Carbon::now()->format('Y-m-d'),
                    'value' => $courePrice,
                    'revenue_for' => $request->program_id,
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

                return $this->returnSuccessMessage(trans('site.enrolled_in_program_successfully'));
            } else {
                return $this->returnError(trans('site.already_enrolled_in_this_program'), 500);
            }
        }
    }


}
