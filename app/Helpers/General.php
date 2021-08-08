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
        return LaravelLocalization::getCurrentLocale() ;
    }
}

//  get active languages Helper Function
if (!function_exists('admin')) {
    function admin()
    {
        return  auth()->guard('admin');
    }
}




//  get active languages Helper Function
if (!function_exists('getActiveLanguages')) {
    function getActiveLanguages()
    {
        return App\Models\Language::active()->get();
    }
}



function websiteMainPage()
{
    return App\Models\Website_main_page::orderBy('id', 'desc')->first();
}


function websiteVisitors()
{
    return \App\Models\Website_visitor::count();
}

function reverseDate($date){
    $array=explode("-",$date);
    $rev=array_reverse($array);
    $date=implode("-",$rev);
    return $date;
}


function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return  preg_replace('/[^\w\s\-]+/u','' ,$string);
}

function clearArabic($string ){
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return  preg_replace('/[^\w\s\-]+/u','' ,$string);

}

function returnSpaceBetweenString($string){
    return  $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
}
