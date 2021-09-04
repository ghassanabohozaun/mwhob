<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentLoginRequest;
use App\Models\Mawhob;

class StudentLoginController extends Controller
{
    //////////////////////////////////////////////
    /// get Login
    public function getLogin()
    {
        $title = trans('site.login');
        return view('student.auth.login', compact('title'));

    }

    //////////////////////////////////////////////
    /// do Login
    public function doLogin(StudentLoginRequest $request)
    {

        $student = Mawhob::where('mawhob_mobile_no', $request->mawhob_mobile_no)->first();
        if (!$student) {
            return redirect()->route('get.student.login')
                ->with(['error' => trans('login.account_unavailable')]);
        }else{

            if ($student->freeze == 'on') {
                if (auth()->guard('student')->attempt(['mawhob_mobile_no' => $request->input('mawhob_mobile_no'),
                    'password' => $request->input('password')])) {
                    return redirect()->route('student.portfolio');
                } else {
                    return redirect()->route('get.student.login')->with(['error' => trans('login.login_failed')]);
                }// end  auth else

            }else{
                return redirect()->route('get.student.login')
                    ->with(['error' => trans('login.account_disabled')]);
            }
        }//end student else


    }


    //////////////////////////////////////////////
    /// logout
    public function logout()
    {
        auth()->guard('student')->logout();
        return redirect()->route('get.student.login');
    }

}
