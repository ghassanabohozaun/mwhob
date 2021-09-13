<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ContestResource;
use App\Http\Resources\NotificationResource;
use App\Models\Category;
use App\Models\Contest;
use App\Models\Mawhoob_Notification;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    use GeneralTrait;


    /////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.notifications');
        return view('admin.notifications.index', compact('title'));
    }


    ////////////////////////////////////////
    /// get Notifications Resource
    public function getNotificationsResource(Request $request)
    {

        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }
        $list = Mawhoob_Notification::orderByDesc('created_at')->where('notify_for', 'admin')
            ->offset($offset)->take($perPage)->get();
        $arr = NotificationResource::collection($list);
        $recordsTotal = Mawhoob_Notification::where('notify_for', 'admin')->get()->count();
        $recordsFiltered = Mawhoob_Notification::where('notify_for', 'admin')->get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }


    ////////////////////////////////////////////////////
    /// get admin notifications
    public function getNotifications()
    {
        $notifications = Mawhoob_Notification::orderByDesc('id')->where('notify_for', 'admin')->get();

        return view('admin.includes.notifications', compact('notifications'));
    }

    ////////////////////////////////////////////////////
    /// get one admin notification
    public function getOneNotification(Request $request)
    {
        $notification = Mawhoob_Notification::find($request->id);
        return $this->returnData('OK', 'data', $notification);
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
