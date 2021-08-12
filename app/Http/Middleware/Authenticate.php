<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Request::is('admin/*')) {
                return route('get.admin.login');
            }else if(Request::is('teacher/*')){
                return route('get.teacher.login');
            } else {
                return route('get.student.login');
                //return route('login');
             }
        }
    }
}
