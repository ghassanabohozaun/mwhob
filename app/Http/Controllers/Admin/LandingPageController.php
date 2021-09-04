<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutMawhobRequest;
use App\Http\Requests\IndexPageRequest;
use App\Http\Requests\StaticStringRequest;
use App\Http\Requests\TeamRequest;
use App\Http\Requests\WhyChooseUsRequest;
use App\Http\Resources\TeamResource;
use App\Models\AboutMawhob;
use App\Models\BestMawhob;
use App\Models\IndexPage;
use App\Models\Mawhob;
use App\Models\StaticString;
use App\Models\Team;
use App\Models\WhyChooseUs;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{
    use GeneralTrait;


    /////////////////////////////////////////////////////
    /// index page
    public function indexPage()
    {
        $title = trans('menu.index');
        $mawhobs = Mawhob::get();
        return view('admin.landing-page.index-page', compact('title', 'mawhobs'));
    }
    /////////////////////////////////////////////////////
    /// Store index page
    public function storeIndexPage(IndexPageRequest $request)
    {

        $indexPage = IndexPage::get();

        if ($indexPage->isEmpty()) {

            IndexPage::create([
                'mawhobs_description_ar' => $request->mawhobs_description_ar,
                'mawhobs_description_en' => $request->mawhobs_description_en,
                'courses_description_ar' => $request->courses_description_ar,
                'courses_description_en' => $request->courses_description_en,
                'best_mawhobs_description_ar' => $request->best_mawhobs_description_ar,
                'best_mawhobs_description_en' => $request->best_mawhobs_description_en,
                'best_courses_description_ar' => $request->best_courses_description_ar,
                'best_courses_description_en' => $request->best_courses_description_en,
                'about_team_ar' => $request->about_team_ar,
                'about_team_en' => $request->about_team_en,
                'our_mission_ar' => $request->our_mission_ar,
                'our_mission_en' => $request->our_mission_en,
            ]);

            if ($request->has('best_mawhobs')) {
                foreach ($request->input('best_mawhobs') as $mawhob) {
                    $bestMawhob = new BestMawhob();
                    $bestMawhob->mawhob_id = $mawhob;
                    $bestMawhob->save();
                }
            }

            return $this->returnSuccessMessage(trans('general.add_success_message'));
        } else {

            $indexPageUpdate = IndexPage::orderBy('id', 'desc')->first();


            $indexPageUpdate->update([
                'mawhobs_description_ar' => $request->mawhobs_description_ar,
                'mawhobs_description_en' => $request->mawhobs_description_en,
                'courses_description_ar' => $request->courses_description_ar,
                'courses_description_en' => $request->courses_description_en,
                'best_mawhobs_description_ar' => $request->best_mawhobs_description_ar,
                'best_mawhobs_description_en' => $request->best_mawhobs_description_en,
                'best_courses_description_ar' => $request->best_courses_description_ar,
                'best_courses_description_en' => $request->best_courses_description_en,
                'about_team_ar' => $request->about_team_ar,
                'about_team_en' => $request->about_team_en,
                'our_mission_ar' => $request->our_mission_ar,
                'our_mission_en' => $request->our_mission_en,
            ]);


            if ($request->has('best_mawhobs')) {
                BestMawhob::truncate();
                foreach ($request->input('best_mawhobs') as $mawhob) {
                    $bestMawhob = new BestMawhob();
                    $bestMawhob->mawhob_id = $mawhob;
                    $bestMawhob->save();
                }
            }

            return $this->returnSuccessMessage(trans('general.update_success_message'));
        }

    }

    /////////////////////////////////////////////////////
    /// About Mawob
    public function aboutMawob()
    {
        $title = trans('menu.about_mawhob');
        return view('admin.landing-page.about-mawhob', compact('title'));
    }
    /////////////////////////////////////////////////////
    /// Store About Mawob
    public function storeAboutMawob(AboutMawhobRequest $request)
    {

        $aboutMawhob = AboutMawhob::get();

        if ($aboutMawhob->isEmpty()) {

            if ($request->hasFile('video')) {
                $video_path = $request->file('video')->store('AboutMawhobVideo');
            } else {
                $video_path = '';
            }

            AboutMawhob::create([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'summary_ar' => $request->summary_ar,
                'summary_en' => $request->summary_en,
                'details_ar' => $request->details_ar,
                'details_en' => $request->details_en,
                'video' => $video_path,
            ]);
            return $this->returnSuccessMessage(trans('general.add_success_message'));
        } else {

            $aboutMawhobUpdate = AboutMawhob::orderBy('id', 'desc')->first();


            if ($request->hasFile('video')) {
                if (!empty($aboutMawhobUpdate->video)) {
                    Storage::delete($aboutMawhobUpdate->video);
                    $video_path_update = $request->file('video')->store('AboutMawhobVideo');
                } else {
                    $video_path_update = $request->file('video')->store('AboutMawhobVideo');
                }
            } else {
                if (!empty($aboutMawhobUpdate->video)) {
                    $video_path_update = $aboutMawhobUpdate->video;
                } else {
                    $video_path_update = '';
                }
            }

            $aboutMawhobUpdate->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'summary_ar' => $request->summary_ar,
                'summary_en' => $request->summary_en,
                'details_ar' => $request->details_ar,
                'details_en' => $request->details_en,
                'video' => $video_path_update,
            ]);

            return $this->returnSuccessMessage(trans('general.update_success_message'));
        }

    }

    /////////////////////////////////////////////////////
    /// Footer Images
    public function footerImages()
    {
        $title = trans('menu.footer_images');
        return view('admin.landing-page.footer-images', compact('title'));
    }

    /////////////////////////////////////////////////////////////////////////////////////////
    /// upload Footer Images
    public function uploadFooterImages(Request $request)
    {
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('FooterImages');
            $file = File::create([
                'file_name' => $request->file('file')->getClientOriginalName(),
                'file_size' => $request->file('file')->getSize(),
                'file_path' => 'FooterImages',
                'file_after_upload' => $request->file('file')->hashName(),
                'full_path_after_upload' => $filePath,
                'file_mimes_type' => $request->file('file')->getMimeType(),
                'file_type' => 'FooterImages',
                'relation_id' => 'FooterImages112212122',
            ]);
        }
        return response(['status' => true, 'id' => $file->id], 200);
    }


    ////////////////////////////////////////////////
    /// delete Footer Images
    public function deleteFooterImages(Request $request)
    {
        if ($request->ajax()) {
            $file = File::find($request->id);
            Storage::delete($file->full_path_after_upload);
            $file->delete();
            return $this->returnSuccessMessage(trans('general.delete_success_message'));
        }
    }


    /////////////////////////////////////////////////////
    /// Teams Index
    public function team()
    {
        $title = trans('menu.team');
        return view('admin.landing-page.teams.index', compact('title'));
    }

    /////////////////////////////////////////////////////
    /// get teams
    public function getTeam(Request $request)
    {
        $perPage = 10;
        if ($request->has('length')) {
            $perPage = $request->length;
        }
        $offset = 0;
        if ($request->has('start')) {
            $offset = $request->start;
        }
        $list = Team::orderByDesc('created_at')->offset($offset)->take($perPage)->get();
        $arr = TeamResource::collection($list);
        $recordsTotal = Team::get()->count();
        $recordsFiltered = Team::get()->count();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr
        ]);
    }

    /////////////////////////////////////////////
    /// store team
    public function storeTeam(TeamRequest $request)
    {
        try {

            if ($request->has('team_image')) {
                $image_path = $request->file('team_image')->store('TeamImages');
            } else {
                $image_path = '';
            }

            Team::create([
                'team_image' => $image_path,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'position_ar' => $request->position_ar,
                'position_en' => $request->position_en,
            ]);
            return $this->returnSuccessMessage(trans('general.add_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch

    }

    /////////////////////////////////////////
    ///  teams destroy
    public function destroyTeam(Request $request)
    {
        try {
            if ($request->ajax()) {
                $team = Team::find($request->id);
                if (!$team) {
                    return redirect()->route('admin.not.found');
                }
                if (!empty($team->team_image)) {
                    Storage::delete($team->team_image);
                }
                $team->delete();
                return $this->returnSuccessMessage(trans('general.delete_success_message'));
            }
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }



    /////////////////////////////////////////////////////
    /// static strings
    public function staticStrings()
    {
        $title = trans('menu.static_strings');
        return view('admin.landing-page.static-strings', compact('title'));
    }
    /////////////////////////////////////////////////////
    /// store static strings
    public function storeStaticStrings(StaticStringRequest $request)
    {

        $staticString = StaticString::get();

        if ($staticString->isEmpty()) {

            StaticString::create([
                'talents_description_ar' => $request->talents_description_ar,
                'talents_description_en' => $request->talents_description_en,
                'soundtrack_description_ar' => $request->soundtrack_description_ar,
                'soundtrack_description_en' => $request->soundtrack_description_en,
                'videos_description_ar' => $request->videos_description_ar,
                'videos_description_en' => $request->videos_description_en,
                'success_stories_description_ar' => $request->success_stories_description_ar,
                'success_stories_description_en' => $request->success_stories_description_en,
                'success_story_categories_description_ar' => $request->success_story_categories_description_ar,
                'success_story_categories_description_en' => $request->success_story_categories_description_en,
                'success_story_description_ar' => $request->success_story_description_ar,
                'success_story_description_en' => $request->success_story_description_en,
                'success_story_person_description_ar' => $request->success_story_person_description_ar,
                'success_story_person_description_en' => $request->success_story_person_description_en,
                'programs_description_ar' => $request->programs_description_ar,
                'programs_description_en' => $request->programs_description_en,
                'courses_description_ar' => $request->courses_description_ar,
                'courses_description_en' => $request->courses_description_en,
                'contests_description_ar' => $request->contests_description_ar,
                'contests_description_en' => $request->contests_description_en,
                'summer_camps_description_ar' => $request->summer_camps_description_ar,
                'summer_camps_description_en' => $request->summer_camps_description_en,
                'magazine_description_ar' => $request->magazine_description_ar,
                'magazine_description_en' => $request->magazine_description_en,
                'latest_winners_description_ar' => $request->latest_winners_description_ar,
                'latest_winners_description_en' => $request->latest_winners_description_en,

            ]);
            return $this->returnSuccessMessage(trans('general.add_success_message'));
        } else {

            $staticStringUpdate = StaticString::orderBy('id', 'desc')->first();


            $staticStringUpdate->update([
                'talents_description_ar' => $request->talents_description_ar,
                'talents_description_en' => $request->talents_description_en,
                'soundtrack_description_ar' => $request->soundtrack_description_ar,
                'soundtrack_description_en' => $request->soundtrack_description_en,
                'videos_description_ar' => $request->videos_description_ar,
                'videos_description_en' => $request->videos_description_en,
                'success_stories_description_ar' => $request->success_stories_description_ar,
                'success_stories_description_en' => $request->success_stories_description_en,
                'success_story_categories_description_ar' => $request->success_story_categories_description_ar,
                'success_story_categories_description_en' => $request->success_story_categories_description_en,
                'success_story_description_ar' => $request->success_story_description_ar,
                'success_story_description_en' => $request->success_story_description_en,
                'success_story_person_description_ar' => $request->success_story_person_description_ar,
                'success_story_person_description_en' => $request->success_story_person_description_en,
                'programs_description_ar' => $request->programs_description_ar,
                'programs_description_en' => $request->programs_description_en,
                'courses_description_ar' => $request->courses_description_ar,
                'courses_description_en' => $request->courses_description_en,
                'contests_description_ar' => $request->contests_description_ar,
                'contests_description_en' => $request->contests_description_en,
                'summer_camps_description_ar' => $request->summer_camps_description_ar,
                'summer_camps_description_en' => $request->summer_camps_description_en,
                'magazine_description_ar' => $request->magazine_description_ar,
                'magazine_description_en' => $request->magazine_description_en,
                'latest_winners_description_ar' => $request->latest_winners_description_ar,
                'latest_winners_description_en' => $request->latest_winners_description_en,
            ]);

            return $this->returnSuccessMessage(trans('general.update_success_message'));
        }

    }



    /////////////////////////////////////////////////////
    /// why choose us
    public function whyChooseUs()
    {
        $title = trans('menu.why_choose_us');
        return view('admin.landing-page.why-choose-us', compact('title'));
    }

    /////////////////////////////////////////////////////
    /// store why choose us
    public function storeWhyChooseUs(WhyChooseUsRequest $request)
    {
        $whyChooseUs = WhyChooseUs::get();
        if ($whyChooseUs->isEmpty()) {
            WhyChooseUs::create([
                'why_choose_us_ar' => $request->why_choose_us_ar,
                'why_choose_us_en' => $request->why_choose_us_en,
                'reason_1' => $request->reason_1,
                'reason_2' => $request->reason_2,
                'reason_3' => $request->reason_3,
                'reason_4' => $request->reason_4,
                'reason_5' => $request->reason_5,
                'reason_6' => $request->reason_6,
                'reason_7' => $request->reason_7,
                'reason_en_1' => $request->reason_en_1,
                'reason_en_2' => $request->reason_en_2,
                'reason_en_3' => $request->reason_en_3,
                'reason_en_4' => $request->reason_en_4,
                'reason_en_5' => $request->reason_en_5,
                'reason_en_6' => $request->reason_en_6,
                'reason_en_7' => $request->reason_en_7,
            ]);
            return $this->returnSuccessMessage(trans('general.add_success_message'));
        } else {

            $whyChooseUsUpdate = WhyChooseUs::orderBy('id', 'desc')->first();


            $whyChooseUsUpdate->update([
                'why_choose_us_ar' => $request->why_choose_us_ar,
                'why_choose_us_en' => $request->why_choose_us_en,
                'reason_1' => $request->reason_1,
                'reason_2' => $request->reason_2,
                'reason_3' => $request->reason_3,
                'reason_4' => $request->reason_4,
                'reason_5' => $request->reason_5,
                'reason_6' => $request->reason_6,
                'reason_7' => $request->reason_7,
                'reason_en_1' => $request->reason_en_1,
                'reason_en_2' => $request->reason_en_2,
                'reason_en_3' => $request->reason_en_3,
                'reason_en_4' => $request->reason_en_4,
                'reason_en_5' => $request->reason_en_5,
                'reason_en_6' => $request->reason_en_6,
                'reason_en_7' => $request->reason_en_7,
            ]);

            return $this->returnSuccessMessage(trans('general.update_success_message'));
        }

    }

}
