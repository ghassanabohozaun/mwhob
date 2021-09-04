<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherUpdateRequest;
use App\Models\Teacher;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    use GeneralTrait;
    //////////////////////////////////////////////////////////////////////////////
    /// index
    public function index()
    {
        $id = auth()->guard('teacher')->user()->id;
        $teacher = Teacher::find($id);
        $title = trans('menu.teacher');
        return view('teacher.teacher.index', compact('title', 'teacher'));
    }

    //////////////////////////////////////////////////////////////////////////////
    /// get Teacher By Id
    public function getTeacherById(Request $request)
    {
        $teacher = Teacher::find($request->id);
        if (!$teacher) {
            return redirect()->route('teacher.not.found');
        }
        return $this->returnData('OK', 'data', $teacher);
    }
    //////////////////////////////////////////////////////////////////////////////
    /// Teacher Update
    public function teacherUpdate(TeacherUpdateRequest $request)
    {

        try {
            $teacher = Teacher::find($request->id);
            if (!$teacher) {
                return redirect()->route('teacher.not.found');
            }

            if ($request->hasFile('photo')) {
                if (!empty($teacher->photo)) {
                    Storage::delete($teacher->photo);
                    $photo_path = $request->file('photo')->store('teachers');
                } else {
                    $photo_path = $request->file('photo')->store('teachers');
                }
            } else {
                if (!empty($teacher->photo)) {
                    $photo_path = $teacher->photo;
                } else {
                    $photo_path = '';
                }
            }

            if (!empty($request->input('password'))) {
                $password = bcrypt($request->password);
            } else {
                $password = $teacher->password;
            }

            $teacher->update([
                'name' => $request->name,
                'photo' => $photo_path,
                'password' => $password,
            ]);

            return $this->returnSuccessMessage(trans('general.update_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), '500');
        }
    }



}
