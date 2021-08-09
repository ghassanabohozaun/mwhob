<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Teachers\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function getLogin()
    {
        return view('teacher.auth.login');

    }

    public function doLogin(LoginRequest $request)
    {

        $teacher = Teacher::where('email', $request->email)->first();

        if (!$teacher) {
            return redirect()->route('get.teacher.login')
                ->with(['error' => trans('login.account_unavailable')]);
        } else {
            if($teacher->status == '1'){

                $rememberMe = $request->has('rememberMe') ? true : false;

                if (auth()->guard('teacher')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $rememberMe)) {
                    $teacher->update([
                        'last_login_at' => Carbon::now()->toDateTimeString(),
                        'last_login_ip' => $request->getClientIp()
                    ]);
                    return redirect()->route('teacher.dashboard');

                } else {
                    return redirect()->route('get.teacher.login')->with(['error' => trans('login.login_failed')]);
                }
            }else{
                return redirect()->route('get.teacher.login')
                    ->with(['error' => trans('login.account_disabled')]);
            }

        }

    }

    public function logout()
    {
        auth()->guard('teacher')->logout();
        return redirect()->route('get.teacher.login');
    }

}
