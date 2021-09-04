<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\SignupRequest;
use App\Models\Category;
use App\Models\Mawhob;
use App\Traits\GeneralTrait;

class SignupController extends Controller
{
    use GeneralTrait;

    ///////////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('site.signup');
        $categories = Category::get();
        return view('student.auth.signup', compact('title', 'categories'));
    }
    ///////////////////////////////////////////////////
    /// store
    public function store(SignupRequest $request)
    {


        $mawhoobExists = Mawhob::where('mawhob_mobile_no', $request->mawhob_mobile_no)->first();

        if (!$mawhoobExists) {
            Mawhob::create([
                'slug_mawhob_full_name' => slug($request->mawhob_full_name),
                'mawhob_full_name' => $request->mawhob_full_name,
                'mawhob_mobile_no' => $request->mawhob_mobile_no,
                'mawhob_whatsapp_no' => $request->mawhob_whatsapp_no,
                'mawhob_birthday' => $request->mawhob_birthday,
                'mowhob_gender' => $request->mowhob_gender,
                'category_id' => $request->category_id,
                'portfolio' => $request->portfolio,
                'password' => bcrypt($request->password),

            ]);
            return $this->returnSuccessMessage(trans('site.signup_success_message'));
        } else {
            return $this->returnError(trans('site.you_have_already_registered_with_us'), 500);
        }


    }
}
