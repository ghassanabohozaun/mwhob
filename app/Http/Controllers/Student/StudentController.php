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
use App\Models\SummerCamp;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use GeneralTrait;

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Contest Registration Terms
    public function contestRegistrationTerms($id = null)
    {
        if (!$id) {
            return redirect()->route('contests');
        }
        $title = trans('site.terms_of_registration_for_the_contest');
        return view('student.contest-registration-terms', compact('title', 'id'));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
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



    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Course and Lecture
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Course Checkout
    public function courseCheckout($id = null)
    {
        $course = Course::find($id);
        if(!$course){
            return redirect()->route('index');
        }
        if(!$id){
            return redirect()->route('index');
        }
        $title = trans('site.checkout');
        return view('student.course-checkout', compact('title', 'id', 'course'));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
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


    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Program Checkout
    public function programCheckout($id = null)
    {
        $program = Program::find($id);
        if(!$program){
          return redirect()->route('index');
        }
        if(!$id){
            return redirect()->route('index');
        }
        $title = trans('site.checkout');
        return view('student.program-checkout', compact('title', 'id', 'program'));
    }


    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Summer Camp Checkout
    public function summerCampCheckout($id = null)
    {
        $summerCamp = SummerCamp::find($id);
        if(!$summerCamp){
            return redirect()->route('index');
        }
        if(!$id){
            return redirect()->route('index');
        }
        $title = trans('site.checkout');
        return view('student.summer-camp-checkout', compact('title', 'id', 'summerCamp'));
    }


}
