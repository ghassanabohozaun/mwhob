<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Mawhoob_Notification;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    use GeneralTrait;
    ////////////////////////////////////////////////////
    /// get admin notifications
    public function getNotifications()
    {
        $notifications = Mawhoob_Notification::orderByDesc('id')->where('notify_for', 'mawhob')
            ->where('student_id', student()->id())->take(10)->get();

        return view('site.includes.notifications', compact('notifications'));
    }

    ////////////////////////////////////////////////////
    /// make notification read
    public function makeRead(Request $request)
    {
        $notification = Mawhoob_Notification::find($request->id);
        $notification->notify_class = 'read';
        $notification->save();
        return $this->returnSuccessMessage('OK');
    }

}
