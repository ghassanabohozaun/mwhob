<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    ////////////////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('dashboard.teacher_panel');
        return view('teacher.dashboard', compact('title'));
    }


    ////////////////////////////////////////////////////////
    /// not Found
    public function notFound()
    {
        $title = trans('general.not_found');
        return view('teacher.errors.not-found', compact('title'));
    }
}
