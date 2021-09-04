<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\studentUpdateRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Mawhob;
use App\Models\MawhobEnrollCourse;
use App\Models\MawhobEnrolledContest;
use App\Models\MawhobEnrollProgram;
use App\Models\MawhobSound;
use App\Models\MawhobVideo;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DashboardController extends Controller
{
    use GeneralTrait;

    ////////////////////////////////////////////////////
    /// portfolio
    public function portfolio()
    {
        $title = trans('site.portfolio');
        $studentID = student()->user()->id;
        /////////////////////////////////////////////////////////////////////////////////////////////
        /// Videos

        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $mawhobVideos = MawhobVideo::join('mawhobs', 'mawhob_videos.mawhob_id', '=', 'mawhobs.id')
                ->join('videos', 'mawhob_videos.video_id', '=', 'videos.id')
                ->select('mawhob_videos.id as studentVideotID', 'mawhob_videos.*', 'mawhobs.*', 'videos.*')
                ->orderByDesc('studentVideotID')->where('.mawhob_videos.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('videos.language', 'ar')
                        ->orWhere('videos.language', 'ar_en');
                })->get();
        } else {
            $mawhobVideos = MawhobVideo::join('mawhobs', 'mawhob_videos.mawhob_id', '=', 'mawhobs.id')
                ->join('videos', 'mawhob_videos.video_id', '=', 'videos.id')
                ->select('mawhob_videos.id as studentVideotID', 'mawhob_videos.*', 'mawhobs.*', 'videos.*')
                ->orderByDesc('studentVideotID')->where('.mawhob_videos.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('videos.language', 'ar_en');
                })->get();
        }

        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $mawhobSounds = MawhobSound::join('mawhobs', 'mawhob_sounds.mawhob_id', '=', 'mawhobs.id')
                ->join('sounds', 'mawhob_sounds.sound_id', '=', 'sounds.id')
                ->select('mawhob_sounds.id as studentSoundID', 'mawhob_sounds.*', 'mawhobs.*', 'sounds.*')
                ->orderByDesc('studentSoundID')->where('.mawhob_sounds.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('sounds.language', 'ar')
                        ->orWhere('sounds.language', 'ar_en');
                })->get();
        } else {
            $mawhobSounds = MawhobSound::join('mawhobs', 'mawhob_sounds.mawhob_id', '=', 'mawhobs.id')
                ->join('sounds', 'mawhob_sounds.sound_id', '=', 'sounds.id')
                ->select('mawhob_sounds.id as studentSoundID', 'mawhob_sounds.*', 'mawhobs.*', 'sounds.*')
                ->orderByDesc('studentSoundID')->where('.mawhob_sounds.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('sounds.language', 'ar_en');
                })->get();
        }


        return view('student.portfolio', compact('title', 'mawhobVideos', 'mawhobSounds'));
    }

    ////////////////////////////////////////////////////
    /// courses
    public function courses()
    {
        $title = trans('site.courses');
        $studentID = student()->user()->id;

        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $studentCourses = MawhobEnrollCourse::join('mawhobs', 'mawhob_enroll_courses.mawhob_id', '=', 'mawhobs.id')
                ->join('courses', 'mawhob_enroll_courses.course_id', '=', 'courses.id')
                ->select('mawhob_enroll_courses.id as studentCourseID', 'mawhob_enroll_courses.*', 'mawhobs.*', 'courses.*')
                ->orderByDesc('studentCourseID')->where('.mawhob_enroll_courses.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('courses.language', 'ar')
                        ->orWhere('courses.language', 'ar_en');
                })->paginate(2);

        } else {
            $studentCourses = MawhobEnrollCourse::join('mawhobs', 'mawhob_enroll_courses.mawhob_id', '=', 'mawhobs.id')
                ->join('courses', 'mawhob_enroll_courses.course_id', '=', 'courses.id')
                ->select('mawhob_enroll_courses.id as studentCourseID', 'mawhob_enroll_courses.*', 'mawhobs.*', 'courses.*')
                ->orderByDesc('studentCourseID')->where('.mawhob_enroll_courses.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('courses.language', 'ar_en');
                })->paginate(2);
        }

        return view('student.courses', compact('title', 'studentCourses'));
    }
    ////////////////////////////////////////////////////
    /// courses paging
    public function studentCoursePaging(Request $request)
    {
        if ($request->ajax()) {
            $studentID = student()->user()->id;
            if (LaravelLocalization::getCurrentLocale() == 'ar') {
                $studentCourses = MawhobEnrollCourse::join('mawhobs', 'mawhob_enroll_courses.mawhob_id', '=', 'mawhobs.id')
                    ->join('courses', 'mawhob_enroll_courses.course_id', '=', 'courses.id')
                    ->select('mawhob_enroll_courses.id as studentCourseID', 'mawhob_enroll_courses.*', 'mawhobs.*', 'courses.*')
                    ->orderByDesc('studentCourseID')->where('.mawhob_enroll_courses.mawhob_id', $studentID)
                    ->where(function ($q) {
                        $q->where('courses.language', 'ar')
                            ->orWhere('courses.language', 'ar_en');
                    })->paginate(2);

            } else {
                $studentCourses = MawhobEnrollCourse::join('mawhobs', 'mawhob_enroll_courses.mawhob_id', '=', 'mawhobs.id')
                    ->join('courses', 'mawhob_enroll_courses.course_id', '=', 'courses.id')
                    ->select('mawhob_enroll_courses.id as studentCourseID', 'mawhob_enroll_courses.*', 'mawhobs.*', 'courses.*')
                    ->orderByDesc('studentCourseID')->where('.mawhob_enroll_courses.mawhob_id', $studentID)
                    ->where(function ($q) {
                        $q->where('courses.language', 'ar_en');
                    })->paginate(2);
            }
            return view('student.courses-paging', compact('studentCourses'))->render();

        }

    }


    /////////////////////////////////////////////////////
    /// get Student Course
    public function getStudentCourse($id = null)
    {
        if (!$id) {
            return redirect()->route('student.not.found');
        }
        $title = trans('site.course');
        $course = Course::with('teacher')->find($id);
        $lecture = Lecture::orderByDesc('id')->where('course_id', $id)->first();
        return view('student.course', compact('title', 'course', 'lecture'));
    }



    ////////////////////////////////////////////////////
    /// programs
    public function programs()
    {
        $title = trans('site.programs');
        $studentID = student()->user()->id;
        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $mawhobEnrollPrograms = MawhobEnrollProgram::join('mawhobs', 'mawhob_enroll_programs.mawhob_id', '=', 'mawhobs.id')
                ->join('programs', 'mawhob_enroll_programs.program_id', '=', 'programs.id')
                ->select('mawhob_enroll_programs.id as studentProgramID', 'mawhob_enroll_programs.*', 'mawhobs.*', 'programs.*')
                ->orderByDesc('studentProgramID')->where('.mawhob_enroll_programs.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('programs.language', 'ar')
                        ->orWhere('programs.language', 'ar_en');
                })->paginate(2);
        } else {
            $mawhobEnrollPrograms = MawhobEnrollProgram::join('mawhobs', 'mawhob_enroll_programs.mawhob_id', '=', 'mawhobs.id')
                ->join('programs', 'mawhob_enroll_programs.program_id', '=', 'programs.id')
                ->select('mawhob_enroll_programs.id as studentProgramID', 'mawhob_enroll_programs.*', 'mawhobs.*', 'programs.*')
                ->orderByDesc('studentProgramID')->where('.mawhob_enroll_programs.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('programs.language', 'ar_en');
                })->paginate(2);
        }

        return view('student.programs', compact('title', 'mawhobEnrollPrograms'));
    }
    ////////////////////////////////////////////////////
    /// programs paging
    public function studentProgramsPaging()
    {
        $studentID = student()->user()->id;

        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $mawhobEnrollPrograms = MawhobEnrollProgram::join('mawhobs', 'mawhob_enroll_programs.mawhob_id', '=', 'mawhobs.id')
                ->join('programs', 'mawhob_enroll_programs.program_id', '=', 'programs.id')
                ->select('mawhob_enroll_programs.id as studentProgramID', 'mawhob_enroll_programs.*', 'mawhobs.*', 'programs.*')
                ->orderByDesc('studentProgramID')->where('.mawhob_enroll_programs.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('programs.language', 'ar')
                        ->orWhere('programs.language', 'ar_en');
                })->paginate(2);
        } else {
            $mawhobEnrollPrograms = MawhobEnrollProgram::join('mawhobs', 'mawhob_enroll_programs.mawhob_id', '=', 'mawhobs.id')
                ->join('programs', 'mawhob_enroll_programs.program_id', '=', 'programs.id')
                ->select('mawhob_enroll_programs.id as studentProgramID', 'mawhob_enroll_programs.*', 'mawhobs.*', 'programs.*')
                ->orderByDesc('studentProgramID')->where('.mawhob_enroll_programs.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('programs.language', 'ar_en');
                })->paginate(2);
        }


        return view('student.programs-paging', compact('mawhobEnrollPrograms'))->render();
    }



    ////////////////////////////////////////////////////
    /// contests
    public function contests()
    {
        $title = trans('site.contests');
        $studentID = student()->user()->id;
        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $studentEnrolledContests = MawhobEnrolledContest::join('mawhobs', 'mawhob_enrolled_contests.mawhob_id', '=', 'mawhobs.id')
                ->join('contests', 'mawhob_enrolled_contests.contest_id', '=', 'contests.id')
                ->select('mawhob_enrolled_contests.id as studentContestID', 'mawhob_enrolled_contests.*', 'mawhobs.*', 'contests.*')
                ->orderByDesc('studentContestID')->where('.mawhob_enrolled_contests.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('contests.language', 'ar')
                        ->orWhere('contests.language', 'ar_en');
                })->paginate(3);
        } else {
            $studentEnrolledContests = MawhobEnrolledContest::join('mawhobs', 'mawhob_enrolled_contests.mawhob_id', '=', 'mawhobs.id')
                ->join('contests', 'mawhob_enrolled_contests.contest_id', '=', 'contests.id')
                ->select('mawhob_enrolled_contests.id as studentContestID', 'mawhob_enrolled_contests.*', 'mawhobs.*', 'contests.*')
                ->orderByDesc('studentContestID')->where('.mawhob_enrolled_contests.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('contests.language', 'ar_en');
                })->paginate(3);
        }


        return view('student.contests', compact('title', 'studentEnrolledContests'));
    }
    ////////////////////////////////////////////////////
    ///  Contests Paging
    public function studentContestsPaging()
    {
        $studentID = student()->user()->id;

        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $studentEnrolledContests = MawhobEnrolledContest::join('mawhobs', 'mawhob_enrolled_contests.mawhob_id', '=', 'mawhobs.id')
                ->join('contests', 'mawhob_enrolled_contests.contest_id', '=', 'contests.id')
                ->select('mawhob_enrolled_contests.id as studentContestID', 'mawhob_enrolled_contests.*', 'mawhobs.*', 'contests.*')
                ->orderByDesc('studentContestID')->where('.mawhob_enrolled_contests.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('contests.language', 'ar')
                        ->orWhere('contests.language', 'ar_en');
                })->paginate(3);
        } else {
            $studentEnrolledContests = MawhobEnrolledContest::join('mawhobs', 'mawhob_enrolled_contests.mawhob_id', '=', 'mawhobs.id')
                ->join('contests', 'mawhob_enrolled_contests.contest_id', '=', 'contests.id')
                ->select('mawhob_enrolled_contests.id as studentContestID', 'mawhob_enrolled_contests.*', 'mawhobs.*', 'contests.*')
                ->orderByDesc('studentContestID')->where('.mawhob_enrolled_contests.mawhob_id', $studentID)
                ->where(function ($q) {
                    $q->where('contests.language', 'ar_en');
                })->paginate(3);
        }
        return view('student.contests-paging', compact('studentEnrolledContests'))->render();
    }


    ////////////////////////////////////////////////////
    /// update Account
    public function updateAccount()
    {
        $title = trans('site.update_account');
        $studentID = student()->user()->id;

        $student = Mawhob::find($studentID);
        $categories = Category::get();
        return view('student.update-account', compact('title', 'categories', 'student'));
    }

    ////////////////////////////////////////////////////
    /// update Student Account
    public function updateStudentAccount(studentUpdateRequest $request)
    {


        $student = Mawhob::find($request->id);

        if ($request->hasFile('photo')) {
            if (!empty($student->photo)) {
                Storage::delete($student->photo);
                $photo_path = $request->file('photo')->store('Mowhobs');
            } else {
                $photo_path = $request->file('photo')->store('Mowhobs');
            }
        } else {
            if (!empty($student->photo)) {
                $photo_path = $student->photo;
            } else {
                $photo_path = '';
            }
        }

        if (!empty($request->input('password'))) {
            $password = bcrypt($request->password);
        } else {
            $password = $student->password;
        }
        $student->update([
            'photo' => $photo_path,
            'slug_mawhob_full_name' => slug($request->mawhob_full_name),
            'mawhob_full_name' => $request->mawhob_full_name,
            'password' => $password,
            'mawhob_whatsapp_no' => $request->mawhob_whatsapp_no,
            'mawhob_birthday' => $request->mawhob_birthday,
            'mowhob_gender' => $request->mowhob_gender,
            'category_id' => $request->category_id,
            'portfolio' => $request->portfolio,
        ]);
        return $this->returnSuccessMessage(trans('site.update_account_successfully'));
    }


}
