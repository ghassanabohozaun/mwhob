<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Admin;
use App\Models\Contest;
use App\Models\Course;
use App\Models\Mawhob;
use App\Models\Program;
use App\Models\Revenue;
use App\Models\Setting;
use App\Models\Teacher;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    use GeneralTrait;

    ////////////////////////////////////////////////////////
    /// index
    public function index()
    {
        $title = trans('dashboard.admin_panel');

        $teachersCount = Teacher:: withoutTrashed()->count();
        $mawhobsCount = Mawhob:: withoutTrashed()->count();
        $coursesCount = Course:: withoutTrashed()->count();
        $RevenuesValue = Revenue:: sum('value');

        $courses = Course::with('teacher')->orderBy('id', 'desc')->take(7)->get();
        $contests = Contest::orderBy('id', 'desc')->take(7)->get();
        $revenues = Revenue::with('mawhob')->orderBy('id', 'desc')->take(7)->get();



        /////////////////////////////////////////////////////////////////////////////////////////////
        /// Mawhob Chart
        $mawhobs = Mawhob::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $months = Mawhob::select(DB::raw("Month(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');
        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($months as $index=>$month){
            $datas[$month] = $mawhobs[$index];
        }
        /////////////////////////////////////////////////////////////////////////////////////////////
        /// Revenues Chart
        $Revenues = Revenue::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $RevenueMonths = Revenue::select(DB::raw("Month(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');
        $RevenueData = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($RevenueMonths as $index=>$month){
            $RevenueData[$month] = $Revenues[$index];
        }



        return view('admin.dashboard', compact('title',
            'teachersCount', 'mawhobsCount', 'coursesCount', 'RevenuesValue',
            'courses','contests','datas','RevenueData','revenues'));
    }
    ////////////////////////////////////////////////////////
    /// get Settings
    public function getSettings()
    {
        $title = trans('settings.settings');
        return view('admin.settings', compact('title'));
    }
    ////////////////////////////////////////////////////////
    /// store Settings
    public function storeSettings(SettingRequest $request)
    {

        try {
            $settings = Setting::get();
            if ($settings->isEmpty()) {

                if ($request->hasFile('site_icon')) {
                    $site_icon = $request->file('site_icon')->store('settings');
                }
                if ($request->hasFile('site_logo')) {
                    $site_logo = $request->file('site_logo')->store('settings');
                }


                Setting::create([
                    'site_name_ar' => $request->site_name_ar,
                    'site_name_en' => $request->site_name_en,
                    'site_email' => $request->site_email,
                    'site_gmail' => $request->site_gmail,
                    'site_facebook' => $request->site_facebook,
                    'site_twitter' => $request->site_twitter,
                    'site_youtube' => $request->site_youtube,
                    'site_instagram' => $request->site_instagram,
                    'site_phone' => $request->site_phone,
                    'site_mobile' => $request->site_mobile,
                    'site_lang_en' => $request->site_lang_en,
                    'lang_front_button_status' => $request->lang_front_button_status,
                    'site_description_ar' => $request->site_description_ar,
                    'site_description_en' => $request->site_description_en,
                    'site_keywords_ar' => $request->site_keywords_ar,
                    'site_keywords_en' => $request->site_keywords_en,
                    'site_icon' => $site_icon,
                    'site_logo' => $site_logo,
                ]);
                return $this->returnSuccessMessage(trans('general.add_success_message'));


                /////////////////////////////////////////////////////////////////////////////////////
                /// Update Settings
            } else {

                $settings = Setting::orderBy('id', 'desc')->first();
                //////////////////////////////////////////////////////
                /// check and upload icon and logo

                /// Icon
                if ($request->hasFile('site_icon')) {
                    if (!empty($settings->site_icon)) {
                        Storage::delete($settings->site_icon);
                        $site_icon = $request->file('site_icon')->store('settings');
                    } else {
                        $site_icon = $request->file('site_icon')->store('settings');
                    }
                } else {
                    $site_icon = $settings->site_icon;
                }

                /// logo
                if ($request->has('site_logo')) {
                    if (!empty($settings->site_logo)) {
                        Storage::delete($settings->site_logo);
                        $site_logo = $request->file('site_logo')->store('settings');
                    } else {
                        $site_logo = $request->file('site_logo')->store('settings');
                    }
                } else {
                    $site_logo = $settings->site_logo;
                }


                $settings->update([
                    'site_name_ar' => $request->site_name_ar,
                    'site_name_en' => $request->site_name_en,
                    'site_email' => $request->site_email,
                    'site_gmail' => $request->site_gmail,
                    'site_facebook' => $request->site_facebook,
                    'site_twitter' => $request->site_twitter,
                    'site_youtube' => $request->site_youtube,
                    'site_instagram' => $request->site_instagram,
                    'site_phone' => $request->site_phone,
                    'site_mobile' => $request->site_mobile,
                    'site_lang_en' => $request->site_lang_en,
                    'lang_front_button_status' => $request->lang_front_button_status,
                    'site_description_ar' => $request->site_description_ar,
                    'site_description_en' => $request->site_description_en,
                    'site_keywords_ar' => $request->site_keywords_ar,
                    'site_keywords_en' => $request->site_keywords_en,
                    'site_icon' => $site_icon,
                    'site_logo' => $site_logo,
                ]);

                return $this->returnSuccessMessage(trans('general.update_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }


    ////////////////////////////////////////////////////////
    ///  switchEnglishLang
    public function switchEnglishLang(Request $request)
    {
        try {
            $settings = Setting::orderBy('id', 'desc')->first();
            if ($request->switchStatus == 'false') {
                $settings->site_lang_en = null;
                $settings->save();
            } else {
                $settings->site_lang_en = 'on';
                $settings->save();
            }

            return $this->returnSuccessMessage(trans('general.change_status_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }


    ////////////////////////////////////////////////////////
    ///  switchFrontend Language
    public function switchFrontendLang(Request $request)
    {
        try {
            $settings = Setting::orderBy('id', 'desc')->first();
            if ($request->switchFrontendLanguageStatus == 'false') {
                $settings->lang_front_button_status = null;
                $settings->save();
            } else {
                $settings->lang_front_button_status = 'on';
                $settings->save();
            }

            return $this->returnSuccessMessage(trans('general.change_status_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    ////////////////////////////////////////////////////////
    /// not Found
    public function notFound()
    {
        $title = trans('general.not_found');
        return view('admin.errors.not-found', compact('title'));
    }



}
