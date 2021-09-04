<?php


//  setting Helper Function
if (!function_exists('setting')) {
    function setting()
    {
        return App\Models\Setting::orderBy('id', 'desc')->first();
    }
}

//  get active languages Helper Function
if (!function_exists('getActiveLanguages')) {
    function Lang()
    {
        return LaravelLocalization::getCurrentLocale();
    }
}

//  get admin Helper Function
if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

//  get teacher Helper Function
if (!function_exists('teacher')) {
    function teacher()
    {
        return auth()->guard('teacher');
    }
}


//  get student Helper Function
if (!function_exists('student')) {
    function student()
    {
        return auth()->guard('student');
    }
}


//  check Mawhob Sound Helper Function
if (!function_exists('check_mawhob')) {
    function check_mawhob($Sid, $Mid)
    {
        return App\Models\MawhobSound::where('sound_id', $Sid)->where('mawhob_id', $Mid)
            ->count() > 0 ? true : false;
    }
}


//  check Best Mawhob  Helper Function
if (!function_exists('check_best_mawhob')) {
    function check_best_mawhob($Mid)
    {
        return App\Models\BestMawhob::where('mawhob_id', $Mid)
            ->count() > 0 ? true : false;
    }
}


//  check Mawhob Video Helper Function
if (!function_exists('check_mawhob_video')) {
    function check_mawhob_video($Vid, $Mid)
    {
        return App\Models\MawhobVideo::where('video_id', $Vid)->where('mawhob_id', $Mid)
            ->count() > 0 ? true : false;
    }
}


//  get active languages Helper Function
if (!function_exists('getActiveLanguages')) {
    function getActiveLanguages()
    {
        return App\Models\Language::active()->get();
    }
}

function aboutMawob()
{
    return App\Models\AboutMawhob::orderBy('id', 'desc')->first();
}

function indexPage()
{
    return App\Models\IndexPage::orderBy('id', 'desc')->first();
}

function staticStrings()
{
    return App\Models\StaticString::orderBy('id', 'desc')->first();
}

function footerImages()
{
    return App\File::orderByDesc('id')->take(9)->get();
}

function whyChooseUs()
{
    return App\Models\WhyChooseUs::orderBy('id', 'desc')->first();
}


function websiteVisitors()
{
    return \App\Models\Website_visitor::count();
}

function reverseDate($date)
{
    $array = explode("-", $date);
    $rev = array_reverse($array);
    $date = implode("-", $rev);
    return $date;
}


function slug($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^\w\s\-]+/u', '', $string);
}


function returnSpaceBetweenString($string)
{
    return $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
}


