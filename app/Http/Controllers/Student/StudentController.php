<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\MawhobEnrollCourse;
use App\Models\MawhobEnrolledContest;
use App\Models\MawhobEnrollProgram;
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
                MawhobEnrolledContest::create([
                    'contest_id' => $request->contest_id,
                    'mawhob_id' => $request->mawhob_id,
                    'enrolled_date' => Carbon::now()->format('Y-m-d'),
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

            $mawhobEnrollCourse = MawhobEnrollCourse::
            where('course_id', $request->course_id)
                ->where('mawhob_id', $request->mawhob_id)->get();

            if ($mawhobEnrollCourse->isEmpty()) {
                ////////////////////////////////////////////////////////////////////
                ///// enroll Course
                MawhobEnrollCourse::create([
                    'course_id' => $request->course_id,
                    'mawhob_id' => $request->mawhob_id,
                    'enrolled_date' => Carbon::now()->format('Y-m-d'),
                ]);

                ////////////////////////////////////////////////////////////////////
                ///// enroll Course

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

            $mawhobEnrollProgram = MawhobEnrollProgram::
            where('program_id', $request->program_id)
                ->where('mawhob_id', $request->mawhob_id)->get();

            if ($mawhobEnrollProgram->isEmpty()) {
                ////////////////////////////////////////////////////////////////////
                ///// enroll program
                MawhobEnrollProgram::create([
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

                return $this->returnSuccessMessage(trans('site.enrolled_in_program_successfully'));
            } else {
                return $this->returnError(trans('site.already_enrolled_in_this_program'), 500);
            }
        }
    }


}
