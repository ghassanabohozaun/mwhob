<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupportCenterRequest;
use App\Models\BestMawhob;
use App\Models\Category;
use App\Models\Contest;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Mawhob;
use App\Models\MawhobEnrollCourse;
use App\Models\MawhobEnrolledContest;
use App\Models\MawhobSound;
use App\Models\MawhobVideo;
use App\Models\Program;
use App\Models\Slider;
use App\Models\Sound;
use App\Models\Story;
use App\Models\StoryCategory;
use App\Models\SummerCamp;
use App\Models\SupportCenter;
use App\Models\Team;
use App\Models\Video;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SiteController extends Controller
{
    use GeneralTrait;

    //////////////////////////////////////////////////////////////////////////////////////////
    /////reloadCaptcha
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
    //////////////////////////////////////////////////////////////////////////////////////////
    ///index
    public function index()
    {
        if (Lang() == 'ar') {
            $title = setting()->site_name_ar;
        } else {
            $title = setting()->site_name_en;
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////
        /// Arabic
        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            /// Slider
            $sliders = Slider::orderByDesc('id')->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->take(2)->get();

            /// Course
            $courses = Course::orderByDesc('id')->where('status', 'on')->where('active', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->take(6)->get();


            ////////////////////////////////////////////////////////////////////////////////////////////////
            /// English
        } else {
            /// Slider
            $sliders = Slider::orderByDesc('id')->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->take(2)->get();
            /// Course
            $courses = Course::orderByDesc('id')->where('status', 'on')->where('active', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->take(6)->get();
        }
        $coursesCount = Course::withoutTrashed()->count();
        $mawhobsCount = Mawhob::withoutTrashed()->count();
        $bestMawhoobs = BestMawhob::with('mawhob')->orderByDesc('id')->get();
        $teams = Team::orderByDesc('id')->take(3)->get();

        return view('site.index', compact('title', 'sliders', 'coursesCount', 'mawhobsCount',
            'bestMawhoobs', 'courses', 'teams'));
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    /// Send Contact Message
    public function sendContactMessage(SupportCenterRequest $request)
    {
        try {
            SupportCenter::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'title' => $request->title,
                'message' => $request->message,
            ]);
            return $this->returnSuccessMessage(trans('site.send_success_message'));
        } catch (\Exception $exception) {
            return $this->returnError(trans('general.try_catch_error_message'), 500);
        }//end catch
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    /// about mawhoob
    public function aboutMawhoob()
    {
        $title = trans('site.about_mawhoob');
        return view('site.about-mawhoob', compact('title'));

    }
    //////////////////////////////////////////////////////////////////////////////////////////
    /// programs
    public function programs()
    {
        $title = trans('site.programs');
        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $programs = Program::withoutTrashed()->orderByDesc('id')->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->paginate(2);
        } else {
            $programs = Program::withoutTrashed()->orderByDesc('id')->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->paginate(2);
        }
        return view('site.programs', compact('title', 'programs'));

    }
    //////////////////////////////////////////////////////////////////////////////////////////
    /// programs paging
    function programsPaging(Request $request)
    {
        if ($request->ajax()) {
            if (LaravelLocalization::getCurrentLocale() == 'ar') {
                $programs = Program::withoutTrashed()->orderByDesc('id')->where('status', 'on')
                    ->where(function ($q) {
                        $q->where('language', 'ar')
                            ->orWhere('language', 'ar_en');
                    })->paginate(2);
            } else {
                $programs = Program::withoutTrashed()->orderByDesc('id')->where('status', 'on')
                    ->where(function ($q) {
                        $q->where('language', 'ar_en');
                    })->paginate(2);
            }

            return view('site.programs-paging', compact('programs'))->render();
        }
    }



    //////////////////////////////////////////////////////////////////////////////////////////
    /// Courses
    public function courses()
    {
        $title = trans('site.courses');
        if (LaravelLocalization::getCurrentLocale() == 'ar') {

            ////// Latest Courses
            $latestCourses = Course::withoutTrashed()->with('category')
                ->orderByDesc('id')->where('status', 'on')->where('active', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->take(6)->get();

            //////  Courses
            $courses = Course::withoutTrashed()->with('category')
                ->orderByDesc('id')->where('status', 'on')->where('active', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->paginate(12);


            ////// Categories
            $categories = Category::orderByDesc('id')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->take(8)->get();


            ///// English
        } else {
            ////// Latest Courses
            $latestCourses = Course::withoutTrashed()->with('category')
                ->orderByDesc('id')->where('status', 'on')->where('active', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->take(6)->get();

            //////  Courses
            $courses = Course::withoutTrashed()->with('category')
                ->orderByDesc('id')->where('status', 'on')->where('active', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->paginate(12);

            ////// Categories
            $categories = Category::orderByDesc('id')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->take(8)->get();

        }
        return view('site.courses', compact('title', 'latestCourses', 'courses', 'categories'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////
    /// courses Paging
    public function coursesPaging(Request $request)
    {
        if ($request->ajax()) {
            if (LaravelLocalization::getCurrentLocale() == 'ar') {
                //////  Courses
                $courses = Course::withoutTrashed()->with('category')
                    ->orderByDesc('id')->where('status', 'on')->where('active', 'on')
                    ->where(function ($q) {
                        $q->where('language', 'ar')
                            ->orWhere('language', 'ar_en');
                    })->paginate(12);
            } else {
                //////  Courses
                $courses = Course::withoutTrashed()->with('category')
                    ->orderByDesc('id')->where('status', 'on')->where('active', 'on')
                    ->where(function ($q) {
                        $q->where('language', 'ar_en');
                    })->paginate(12);
            }
            return view('site.courses-paging', compact('courses'))->render();
        }
    }


    //////////////////////////////////////////////////////////////////////////////////////////
    /// Contests
    public function contests()
    {
        $title = trans('site.contests');
        $mawhob_winners = MawhobEnrolledContest::with('mawhob')->with('contest')
            ->orderByDesc('id')->where('mawhob_winner', 'true')->take(6)->get();


        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $contests = Contest::withoutTrashed()->orderByDesc('id')
                ->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->paginate(12);
        } else {
            $contests = Contest::withoutTrashed()->orderByDesc('id')
                ->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->paginate(12);
        }


        return view('site.contests', compact('title', 'mawhob_winners', 'contests'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////
    /// Contests paging
    public function contestsPaging(Request $request)
    {
        if ($request->ajax()) {
            if (LaravelLocalization::getCurrentLocale() == 'ar') {
                $contests = Contest::withoutTrashed()->orderByDesc('id')
                    ->where('status', 'on')
                    ->where(function ($q) {
                        $q->where('language', 'ar')
                            ->orWhere('language', 'ar_en');
                    })->paginate(12);
            } else {
                $contests = Contest::withoutTrashed()->orderByDesc('id')
                    ->where('status', 'on')
                    ->where(function ($q) {
                        $q->where('language', 'ar_en');
                    })->paginate(12);
            }

            return view('site.contests-paging', compact('contests'))->render();
        }
    }


    //////////////////////////////////////////////////////////////////////////////////////////
    /// Summer Camps
    public function summerCamps()
    {
        $title = trans('site.summer_camps');


        if (LaravelLocalization::getCurrentLocale() == 'ar') {

            ////// Latest Summer Camps
            $latestSummerCamps = SummerCamp::withoutTrashed()->orderByDesc('id')
                ->where('status', 'on')
                ->where('year', '=', Carbon::now()->year)
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->paginate(2);

            ////// Summer Camps
            $summerCamps = SummerCamp::withoutTrashed()->orderByDesc('id')
                ->where('status', 'on')
                ->where('year', '!=', Carbon::now()->year)
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->paginate(4);

            ////// Categories
            $categories = Category::orderByDesc('id')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->take(8)->get();

        } else {

            ////// Latest Summer Camps
            $latestSummerCamps = SummerCamp::withoutTrashed()->orderByDesc('id')
                ->where('status', 'on')
                ->where('year', '=', Carbon::now()->year)
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->paginate(2);

            $summerCamps = SummerCamp::withoutTrashed()->orderByDesc('id')
                ->where('status', 'on')
                ->where('year', '!=', Carbon::now()->year)
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->paginate(4);

            ////// Categories
            $categories = Category::orderByDesc('id')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->take(8)->get();
        }
        return view('site.summer-camps', compact('title', 'summerCamps', 'latestSummerCamps','categories'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////
    /// Summer Camps paging
    public function summerCampsPaging(Request $request)
    {
        if ($request->ajax()) {
            if (LaravelLocalization::getCurrentLocale() == 'ar') {
                $summerCamps = SummerCamp::withoutTrashed()->orderByDesc('id')
                    ->where('status', 'on')
                    ->where('year', '!=', Carbon::now()->year)
                    ->where(function ($q) {
                        $q->where('language', 'ar')
                            ->orWhere('language', 'ar_en');
                    })->paginate(4);
            } else {
                $summerCamps = SummerCamp::withoutTrashed()->orderByDesc('id')
                    ->where('status', 'on')
                    ->where('year', '!=', Carbon::now()->year)
                    ->where(function ($q) {
                        $q->where('language', 'ar_en');
                    })->paginate(4);
            }
            return view('site.summer-camps-paging', compact('summerCamps'))->render();
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    /// Magazine
    public function magazine()
    {
        $title = trans('site.mawhoob_magazine');
        return view('site.magazine', compact('title'));
    }



    //////////////////////////////////////////////////////////////////////////////////////////
    /// talents
    public function talents()
    {
        $title = trans('site.talents');
        $soundsCount = Sound::withoutTrashed()->where('status', 'on')->count();
        $videosCount = Video::withoutTrashed()->where('status', 'on')->count();
        $storiesCount = Story::withoutTrashed()->where('status', 'on')->count();

        ////// arabic
        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            ////// Sounds
            $sounds = Sound::withoutTrashed()->orderByDesc('id')
                ->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->take(4)->get();

            ////// Videos
            $videos = Video::withoutTrashed()->orderByDesc('id')
                ->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->take(4)->get();
            ////// English
        } else {
            ////// Sounds
            $sounds = Sound::withoutTrashed()->orderByDesc('id')
                ->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->take(4)->get();
            ////// Videos
            $videos = Video::withoutTrashed()->orderByDesc('id')
                ->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->take(4)->get();
        }

        ///// Success Stories
        $successStories = Story::with('mawhob')->withoutTrashed()
            ->orderByDesc('id')
            ->where('status', 'on')->take(7)->get();

        return view('site.talents', compact('title', 'soundsCount', 'sounds',
            'videosCount', 'videos', 'successStories', 'storiesCount'));
    }


    //////////////////////////////////////////////////////////////////////////////////////////
    /// Sounds
    public function sounds()
    {
        $title = trans('site.sounds');
        $sounds = Sound::getSounds('', '', '', '', '');
        return view('site.sounds', compact('title', 'sounds'));
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    /// get more sounds
    public function getMoreSounds(Request $request)
    {
        $search_name = $request->search_query;
        $length_from = $request->length_from;
        $length_to = $request->length_to;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        if ($request->ajax()) {
            $sounds = Sound::getSounds($search_name, $length_from, $length_to, $date_from, $date_to);
            return view('site.sounds-paging', compact('sounds'))->render();
        }
    }


    //////////////////////////////////////////////////////////////////////////////////////////
    /// Sounds Views
    public function soundViews(Request $request)
    {
        if ($request->ajax()) {
            $sound = Sound::find($request->id);
            $sound->views = $sound->views + 1;
            $sound->save();
            return $this->returnSuccessMessage('OK');
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    /// Sound Filter
    public function soundFilter(Request $request)
    {

        if ($request->ajax()) {
            $sounds = Sound::withoutTrashed()->orderByDesc('id')
                ->where('status', 'on')
                ->get();

            return view('site.videos-paging', compact('sounds'));

        }

    }



    //////////////////////////////////////////////////////////////////////////////////////////
    /// videos
    public function videos()
    {
        $title = trans('site.videos');
        $videos = Video::getVideos('', '', '', '', '');
        return view('site.videos', compact('title', 'videos'));
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    ///  get more Videos
    public function getMoreVideos(Request $request)
    {
        $search_name = $request->search_query;
        $length_from = $request->length_from;
        $length_to = $request->length_to;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        if ($request->ajax()) {
            $videos = Video::getVideos($search_name, $length_from, $length_to, $date_from, $date_to);
            return view('site.videos-paging', compact('videos'))->render();
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    /// Video Views
    public function videoViews(Request $request)
    {
        if ($request->ajax()) {
            $video = Video::find($request->id);
            $video->views = $video->views + 1;
            $video->save();
            return $this->returnSuccessMessage('OK');
        }
    }



    //////////////////////////////////////////////////////////////////////////////////////////
    /// Success Stories Categories
    public function successStoriesCategories()
    {
        $title = trans('site.success_stories_categories');

        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $storyCategories = StoryCategory::orderByDesc('id')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->paginate(9);
        } else {
            $storyCategories = StoryCategory::orderByDesc('id')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->paginate(9);
        }
        return view('site.success-stories.categories', compact('title', 'storyCategories'));
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    /// Success Stories Categories paging
    public function successStoriesCategoriesPaging(Request $request)
    {
        if ($request->ajax()) {
            if (LaravelLocalization::getCurrentLocale() == 'ar') {
                $storyCategories = StoryCategory::orderByDesc('id')
                    ->where(function ($q) {
                        $q->where('language', 'ar')
                            ->orWhere('language', 'ar_en');
                    })->paginate(9);
            } else {
                $storyCategories = StoryCategory::orderByDesc('id')
                    ->where(function ($q) {
                        $q->where('language', 'ar_en');
                    })->paginate(9);
            }
            return view('site.success-stories.categories-paging', compact('storyCategories'))->render();
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    /// Success Stories
    public function successStories($cat = null)
    {
        if (!$cat) {
            return redirect()->route('success.stories.categories');
        }
        $title = trans('site.success_stories');

        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $StoryCategory = StoryCategory::where('slug_name_ar', $cat)->first();

            if (!$StoryCategory) {
                return redirect()->route('success.stories.categories');
            }

            //// Stories
            $stories = Story::with('mawhob')->withoutTrashed()->orderByDesc('id')
                ->where('story_category_id', $StoryCategory->id)
                ->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->paginate(12);
        } else {

            $StoryCategory = StoryCategory::where('slug_name_en', $cat)->first();
            if (!$StoryCategory) {
                return redirect()->route('success.stories.categories');
            }

            //// Stories
            $stories = Story::with('mawhob')->withoutTrashed()->orderByDesc('id')
                ->where('story_category_id', $StoryCategory->id)
                ->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->paginate(12);
        }

        return view('site.success-stories.stories', compact('title', 'stories', 'cat'));
    }


    //////////////////////////////////////////////////////////////////////////////////////////
    /// Success Stories paging
    public function successStoriesPaging(Request $request, $cat = null)
    {

        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $StoryCategory = StoryCategory::where('slug_name_ar', $cat)->first();
            //// Stories
            $stories = Story::with('mawhob')->withoutTrashed()->orderByDesc('id')
                ->where('story_category_id', $StoryCategory->id)
                ->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar')
                        ->orWhere('language', 'ar_en');
                })->paginate(12);
        } else {

            $StoryCategory = StoryCategory::where('slug_name_en', $cat)->first();

            //// Stories
            $stories = Story::with('mawhob')->withoutTrashed()->orderByDesc('id')
                ->where('story_category_id', $StoryCategory->id)
                ->where('status', 'on')
                ->where(function ($q) {
                    $q->where('language', 'ar_en');
                })->paginate(12);
        }

        return view('site.success-stories.stories-paging', compact('stories'))->render();

    }

    //////////////////////////////////////////////////////////////////////////////////////////
    ///  story
    public function story($id = null)
    {
        if (!$id) {
            return redirect()->route('success.stories.categories');
        }
        $title = trans('site.story');
        $story = Story::with('mawhob')->where('id', $id)->first();
        if (!$story) {
            return redirect()->route('success.stories.categories');
        }
        $mawhobID = $story->mawhob_id;


        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $mawhobVideos = MawhobVideo::join('mawhobs', 'mawhob_videos.mawhob_id', '=', 'mawhobs.id')
                ->join('videos', 'mawhob_videos.video_id', '=', 'videos.id')
                ->select('mawhob_videos.id as studentVideoID', 'mawhob_videos.*', 'mawhobs.*', 'videos.*')
                ->orderByDesc('studentVideoID')->where('.mawhob_videos.mawhob_id', $mawhobID)
                ->where(function ($q) {
                    $q->where('videos.language', 'ar')
                        ->orWhere('videos.language', 'ar_en');
                })->get();

        } else {
            $mawhobVideos = MawhobVideo::join('mawhobs', 'mawhob_videos.mawhob_id', '=', 'mawhobs.id')
                ->join('videos', 'mawhob_videos.video_id', '=', 'videos.id')
                ->select('mawhob_videos.id as studentVideotID', 'mawhob_videos.*', 'mawhobs.*', 'videos.*')
                ->orderByDesc('studentVideotID')->where('.mawhob_videos.mawhob_id', $mawhobID)
                ->where(function ($q) {
                    $q->where('videos.language', 'ar_en');
                })->get();
        }


        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $mawhobSounds = MawhobSound::join('mawhobs', 'mawhob_sounds.mawhob_id', '=', 'mawhobs.id')
                ->join('sounds', 'mawhob_sounds.sound_id', '=', 'sounds.id')
                ->select('mawhob_sounds.id as studentSoundID', 'mawhob_sounds.*', 'mawhobs.*', 'sounds.*')
                ->orderByDesc('studentSoundID')->where('.mawhob_sounds.mawhob_id', $mawhobID)
                ->where(function ($q) {
                    $q->where('sounds.language', 'ar')
                        ->orWhere('sounds.language', 'ar_en');
                })->get();
        } else {
            $mawhobSounds = MawhobSound::join('mawhobs', 'mawhob_sounds.mawhob_id', '=', 'mawhobs.id')
                ->join('sounds', 'mawhob_sounds.sound_id', '=', 'sounds.id')
                ->select('mawhob_sounds.id as studentSoundID', 'mawhob_sounds.*', 'mawhobs.*', 'sounds.*')
                ->orderByDesc('studentSoundID')->where('.mawhob_sounds.mawhob_id', $mawhobID)
                ->where(function ($q) {
                    $q->where('sounds.language', 'ar_en');
                })->get();
        }


        return view('site.success-stories.story', compact('title', 'story',
            'mawhobID', 'mawhobVideos', 'mawhobSounds'));
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    ///  Test
    public function myTest()
    {


    }

}
