<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\contestRegistrationTermsRequest;
use App\Models\Course;
use App\Models\lecture_mawhob;
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
    /// Student Enroll Program
    public function contestRegistrationTerms($id = null)
    {
        if (!$id) {
            return redirect()->route('contests');
        }
        $title = trans('site.terms_of_registration_for_the_contest');
        return view('student.contest-registration-terms', compact('title', 'id'));
    }

    ///////////////////////////////////////////////////
    /// Student Enroll Contest
    public function enrollContest(contestRegistrationTermsRequest $request)
    {
            $MawhobEnrolledContest = MawhobEnrolledContest::where('contest_id', $request->contest_id)
                ->where('mawhob_id', $request->mawhob_id)->get();

            if ($MawhobEnrolledContest->isEmpty()) {

                if ($request->has('file')) {
                    $file_path = $request->file('file')->store('ContestFiles');
                } else {
                    $file_path = '';
                }
                ////////////////////////////////////////////////////////////////////
                ///// enroll contest
                $mawhobEnrolledContest = MawhobEnrolledContest::create([
                    'contest_id' => $request->contest_id,
                    'mawhob_id' => $request->mawhob_id,
                    'file' => $file_path,
                    'link' => $request->link,
                    'enrolled_date' => Carbon::now()->format('Y-m-d'),
                ]);

                ////////////////////////////////////////////////////
                ///   enrolled contest Admin notification
                Mawhoob_Notification::create([
                    'title_ar' => 'تنبيه التسجيل في مسابقة',
                    'title_en' => 'Enrolled In Contest Notification',

                    'details_ar' => ' قام الموهوب   ' . $mawhobEnrolledContest->mawhob->mawhob_full_name
                        . ' بالتسجيل في المسابقة التالية  ' . $mawhobEnrolledContest->contest->name_ar,

                    'details_en' => ' The Mawhoob   ' . $mawhobEnrolledContest->mawhob->mawhob_full_name_en
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

                ///////////////////////////////////////////////////////
                /// add  Revenue
                $programPrice = Program::find($request->program_id)->price;
                $programDiscount = Program::find($request->program_id)->discount;

                if ($programDiscount == '' || $programDiscount == 0) {
                    $value = $programPrice;
                } else {
                    $value = $programDiscount;
                }


                Revenue::create([
                    'mawhob_id' => $request->mawhob_id,
                    'date' => Carbon::now()->format('Y-m-d'),
                    'value' => $value,
                    'revenue_for' => $request->program_id,
                    'details' => 'enroll_program',
                ]);

                ////////////////////////////////////////////////////
                ///   enrolled program admin notification
                Mawhoob_Notification::create([
                    'title_ar' => 'تنبيه التسجيل في برنامج',
                    'title_en' => 'Enrolled In Program Notification',

                    'details_ar' => ' قام الموهوب   ' . $mawhobEnrollProgram->mawhob->mawhob_full_name
                        . ' بالتسجيل في البرنامج التالي   ' . $mawhobEnrollProgram->program->name_ar,

                    'details_en' => ' The Mawhoob   ' . $mawhobEnrollProgram->mawhob->mawhob_full_name_en
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
                    'student_id' => student()->id(),
                ]);

                return $this->returnSuccessMessage(trans('site.enrolled_in_program_successfully'));
            } else {
                return $this->returnError(trans('site.already_enrolled_in_this_program'), 500);
            }
        }
    }

    ///////////////////////////////////////////////////
    /// Student Attendance Enroll In Lecture
    public function studentAttendanceEnrollInLecture(Request $request)
    {
        $lectureMawhobExists = lecture_mawhob::where('course_id', '=', $request->course_id)
            ->where('lecture_id', '=', $request->lecture_id)
            ->where('mawhob_id', '=', $request->student_id)
            ->get();

        if ($lectureMawhobExists->isEmpty()) {
            lecture_mawhob::create([
                'course_id' => $request->course_id,
                'lecture_id' => $request->lecture_id,
                'mawhob_id' => $request->student_id,
                'status' => 'on',
            ]);
            return $this->returnSuccessMessage('OK', 200);
        } else {

            return $this->returnError('error', 500);
        }


    }


}
