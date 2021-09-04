<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherLoginRequest;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;


class loginController extends Controller
{
    //////////////////////////////////////////////
    /// get Login
    public function getLogin()
    {
        return view('teacher.auth.login');

    }
    //////////////////////////////////////////////
    /// do Login
    public function doLogin(TeacherLoginRequest $request)
    {



        $teacher = Teacher::where('teacher_email', $request->teacher_email)->first();

        if (!$teacher) {
            return redirect()->route('get.teacher.login')
                ->with(['error' => trans('login.account_unavailable')]);
        } else {
            if ($teacher->teacher_freeze == 'on') {

                $rememberMe = $request->has('teacher_remember_token') ? true : false;

                if (auth()->guard('teacher')->attempt(['teacher_email' => $request->input('teacher_email'),
                    'password' => $request->input('password')], $rememberMe)) {
                    $teacher->update([
                        'teacher_last_login_at' => Carbon::now()->toDateTimeString(),
                        'teacher_last_login_ip' => $request->getClientIp()
                    ]);
                    return redirect()->route('teacher.profile');

                } else {
                    return redirect()->route('get.teacher.login')->with(['error' => trans('login.login_failed')]);
                }
            } else {
                return redirect()->route('get.teacher.login')
                    ->with(['error' => trans('login.account_disabled')]);
            }
        }

    }
    //////////////////////////////////////////////
    /// logout
    public function logout()
    {
        auth()->guard('teacher')->logout();
        return redirect()->route('get.teacher.login');
    }


}
