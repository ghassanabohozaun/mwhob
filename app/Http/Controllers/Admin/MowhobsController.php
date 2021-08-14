<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MowhobRequest;
use App\Http\Resources\MowhobsResource;
use App\Http\Resources\MowhobsTrashedResource;
use App\Models\Category;
use App\Models\Mawhob;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MowhobsController extends Controller
{
    use GeneralTrait;

    /////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('menu.mowhobs');
        return view('admin.mowhobs.index', compact('title'));
    }
    /////////////////////////////////////////
    /// Get Mowhobs
    public function getMowhobs(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }

        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }

        $list = Mawhob::with('category')->orderByDesc('created_at')->offset($offset)->take($perPage)->get();
        $arr = MowhobsResource::collection($list);
        $recordsTotal = Mawhob::get()->count();
        $recordsFiltered = Mawhob::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    /////////////////////////////////////////
    /// Get Trashed mowhobs index
    public function trashedMowhob()
    {
        $title = trans('mowhob.trashed_mowhobs');
        return view('admin.mowhobs.trashed-mowhobs', compact('title'));
    }
    /////////////////////////////////////////
    /// Get Trashed mowhobs
    public function getTrashedMowhobs(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }

        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }

        $list = Mawhob::onlyTrashed()->with('category')->orderByDesc('created_at')->offset($offset)->take($perPage)->get();
        $arr = MowhobsTrashedResource::collection($list);
        $recordsTotal = Mawhob::get()->count();
        $recordsFiltered = Mawhob::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }
    ///////////////////////////////////////////
    /// create
    public function create()
    {
        $title = trans('menu.add_new_mowhob');
        $categories = Category::get();
        return view('admin.mowhobs.create', compact('title', 'categories'));
    }
    /////////////////////////////////////////
    ///  store
    public function store(MowhobRequest $request)
    {

        try {
            if ($request->hasFile('photo')) {
                $photo_path = $request->file('photo')->store('Mowhobs');
            } else {
                $photo_path = '';
            }

            Mawhob::create([
                'photo' => $photo_path,
                'mawhob_full_name' => $request->mawhob_full_name,
                'mawhob_mobile_no' => $request->mawhob_mobile_no,
                'mawhob_password' =>  $request->mawhob_password,
                'mawhob_whatsapp_no' => $request->mawhob_whatsapp_no,
                'mawhob_birthday' => $request->mawhob_birthday,
                'mowhob_gender' => $request->mowhob_gender,
                'category_id' => $request->category_id,
                'portfolio' => $request->portfolio,

            ]);
            return $this->returnSuccessMessage(trans('general.add_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
    /////////////////////////////////////////
    /// edit
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $mowhob = Mawhob::find($id);
        if (!$mowhob) {
            return redirect()->route('admin.not.found');
        }
        $categories = Category::get();
        $title = trans('mowhob.update_mowhob');

        return view('admin.mowhobs.update', compact('title', 'mowhob', 'categories'));
    }
    /////////////////////////////////////////
    ///  update
    public function update(MowhobRequest $request)
    {

        try {
            $mowhob = Mawhob::find($request->id);

            if ($request->hasFile('photo')) {
                if (!empty($mowhob->photo)) {
                    Storage::delete($mowhob->photo);
                    $photo_path = $request->file('photo')->store('Mowhobs');
                } else {
                    $photo_path = $request->file('photo')->store('Mowhobs');
                }
            } else {
                if (!empty($mowhob->photo)) {
                    $photo_path = $mowhob->photo;
                } else {
                    $photo_path = '';
                }
            }
            $mowhob->update([
                'photo' => $photo_path,
                'mawhob_full_name' => $request->mawhob_full_name,
                'mawhob_mobile_no' => $request->mawhob_mobile_no,
                'mawhob_password' => $request->mawhob_password,
                'mawhob_whatsapp_no' => $request->mawhob_whatsapp_no,
                'mawhob_birthday' => $request->mawhob_birthday,
                'mowhob_gender' => $request->mowhob_gender,
                'category_id' => $request->category_id,
                'portfolio' => $request->portfolio,
            ]);
            return $this->returnSuccessMessage(trans('general.update_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    /////////////////////////////////////////
    ///  restore
    public function restore(Request $request)
    {
        try {
            if ($request->ajax()) {
                $mowhob = Mawhob::onlyTrashed()->find($request->id);
                if (!$mowhob) {
                    return redirect()->route('admin.not.found');
                }
                $mowhob->restore();
                return $this->returnSuccessMessage(trans('general.restore_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }
    /////////////////////////////////////////
    ///  Destroy
    public function destroy(Request $request)
    {
        try {
            if ($request->ajax()) {
                $mowhob = Mawhob::find($request->id);
                if (!$mowhob) {
                    return redirect()->route('admin.not.found');
                }
                $mowhob->delete();
                return $this->returnSuccessMessage(trans('general.move_to_trash'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    ///  force delete
    public function forceDelete(Request $request)
    {
        try {
            if ($request->ajax()) {
                $mowhob = Mawhob::onlyTrashed()->find($request->id);
                if (!$mowhob) {
                    return redirect()->route('admin.not.found');
                }
                if (!empty($mowhob->photo)) {
                    Storage::delete($mowhob->photo);
                }
                $mowhob->forceDelete();

                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    /// change  status
    public function changeStatus(Request $request)
    {

        $mowhob = Mawhob::find($request->id);
        if ($request->switchStatus == 'false') {
            $mowhob->freeze = null;
            $mowhob->save();
        } else {
            $mowhob->freeze = 'on';
            $mowhob->save();
        }
        return $this->returnSuccessMessage(trans('general.change_status_success_message'));


    }


    ///////////////////////////////////////
    /// profile
    public function profile($id = null)
    {
        if (!$id) {
            return redirect()->route('admin.not.found');
        }
        $mowhob = Mawhob::find($id);
        if (!$mowhob) {
            return redirect()->route('admin.not.found');
        }

        $title = trans('mowhob.profile');

        return view('admin.mowhobs.profile', compact('title', 'mowhob'));
    }
}
