<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlidersRequest;
use App\Http\Requests\SlidersUpdateRequest;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlidersController extends Controller
{
    use GeneralTrait;

    ////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.sliders');
        return view('admin.landing-page.sliders.index', compact('title'));
    }
    ////////////////////////////////////////////
    /// get Sliders
    public function getSliders(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }

        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }

        $list = Slider::orderByDesc('created_at')->offset($offset)->take($perPage)->get();
        $arr = SliderResource::collection($list);
        $recordsTotal = Slider::get()->count();
        $recordsFiltered = Slider::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);

    }

    ////////////////////////////////////////////
    /// create
    public function create()
    {
        $title = trans('menu.add_new_slider');
        return view('admin.landing-page.sliders.create', compact('title'));
    }
    //////////////////////////////////////////////////////////////////////
    ///Store Slider function

    protected function store(SlidersRequest $request)
    {

        try {
            if ($request->hasFile('photo')) {
                $photo_path = $request->file('photo')->store('sliders');
            } else {
                $photo_path = '';
            }

            if (setting()->site_lang_en == 'on') {
                Slider::create([
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'details_ar' => $request->details_ar,
                    'details_en' => $request->details_en,
                    'details_status' => $request->details_status,
                    'button_status' => $request->button_status,
                    'url_ar' => $request->url_ar,
                    'url_en' => $request->url_en,
                    'photo' => $photo_path,
                    'language' => 'ar_en',
                ]);

            } else {
                Slider::create([
                    'title_ar' => $request->title_ar,
                    'title_en' => null,
                    'details_ar' => $request->details_ar,
                    'details_en' => null,
                    'details_status' => $request->details_status,
                    'button_status' => $request->button_status,
                    'url_ar' => $request->url_ar,
                    'url_en' => null,
                    'photo' => $photo_path,
                    'language' => 'ar',
                ]);
            }
            return $this->returnSuccessMessage(trans('general.add_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ////////////////////////////////////////////
    /// edit
    public function edit($id = null)
    {
        $title = trans('sliders.slider_update');
        $slider = Slider::find($id);
        if (!$slider) {
            return redirect()->route('admin.not.found');
        }
        return view('admin.landing-page.sliders.update', compact('title', 'slider'));
    }


    //////////////////////////////////////////////////////////////////////
    /// update Slider function
    protected function update(SlidersUpdateRequest $request)
    {


        try {
            $slider = Slider::find($request->id);
            if (!$slider) {
                return redirect()->route('admin.not.found');
            }
            //// check photo
            if ($request->hasFile('photo')) {
                if (!empty($slider->photo)) {
                    Storage::delete($slider->photo);
                    $photo_path = $request->file('photo')->store('sliders');
                } else {
                    $photo_path = $request->file('photo')->store('sliders');
                }
            } else {
                if (!empty($slider->photo)) {
                    $photo_path = $slider->photo;
                } else {
                    $photo_path = '';
                }
            }

            if (setting()->site_lang_en == 'on') {
                $slider->update([
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'details_ar' => $request->details_ar,
                    'details_en' => $request->details_en,
                    'details_status' => $request->details_status,
                    'button_status' => $request->button_status,
                    'url_ar' => $request->url_ar,
                    'url_en' => $request->url_en,
                    'photo' => $photo_path,
                    'language' => 'ar_en',
                ]);
            } else {
                $slider->update([
                    'title_ar' => $request->title_ar,
                    'title_en' => null,
                    'details_ar' => $request->details_ar,
                    'details_en' => null,
                    'details_status' => $request->details_status,
                    'button_status' => $request->button_status,
                    'url_ar' => $request->url_ar,
                    'url_en' => null,
                    'photo' => $photo_path,
                    'language' => 'ar',
                ]);
            }
            return $this->returnSuccessMessage(trans('general.update_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    ////////////////////////////////////////////
    /// destroy
    public function destroy(Request $request)
    {

        try {
            if ($request->ajax()) {
                $slider = Slider::find($request->id);
                if (!$slider) {
                    return redirect()->route('admin.not.found');
                }

                if (!empty($slider->photo)) {
                    Storage::delete($slider->photo);
                }
                $slider->delete();
                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), '500');
        }

    }

    ////////////////////////////////////////////////////////////////////
    /// change Status
    public function changeStatus(Request $request)
    {
        try {
            $slider = Slider::find($request->id);
            if ($request->switchStatus == 'false') {
                $slider->status = null;
                $slider->save();
            } else {
                $slider->status = 'on';
                $slider->save();
            }
            return $this->returnSuccessMessage(trans('general.change_status_success_message'));

        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }
}
