<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'namespace' => 'Site',
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {


    ////////////////////////////////////////////////////////////
    /// any
    Route::get('', function () {
        return view('site.index');
    })->where(['any' => '.*']);

    Route::get('/', 'SiteController@index')->name('index');
    Route::get('/reload-captcha', 'SiteController@reloadCaptcha')->name('reload.Captcha');
    Route::post('/send-contact-message', 'SiteController@sendContactMessage')->name('send.contact.message');
    Route::get('/about-mawhoob', 'SiteController@aboutMawhoob')->name('about.mawhoob');
    Route::get('/programs', 'SiteController@programs')->name('programs');
    Route::get('/programs/paging', 'SiteController@programsPaging')->name('programs.paging');
    Route::get('/courses', 'SiteController@courses')->name('courses');
    Route::get('/courses/paging', 'SiteController@coursesPaging')->name('courses.paging');
    Route::get('/contests', 'SiteController@contests')->name('contests');
    Route::get('/contests/paging', 'SiteController@contestsPaging')->name('contests.paging');
    Route::get('/summer-camps', 'SiteController@summerCamps')->name('summer.camps');
    Route::get('/summer-camps/paging', 'SiteController@summerCampsPaging')->name('summer.camps.paging');
    Route::get('/magazine', 'SiteController@magazine')->name('magazine');
    Route::get('/talents', 'SiteController@talents')->name('talents');

    Route::any('/sounds', 'SiteController@sounds')->name('sounds');
    Route::get('/get/more/sounds', 'SiteController@getMoreSounds')->name('get.more.sounds');
    Route::post('/sound/views', 'SiteController@soundViews')->name('sound.views');


    Route::get('/videos', 'SiteController@videos')->name('videos');
    Route::get('/get/more/videos', 'SiteController@getMoreVideos')->name('get.more.videos');
    Route::post('/video/views', 'SiteController@videoViews')->name('video.views');


    Route::get('/success-stories-categories', 'SiteController@successStoriesCategories')
        ->name('success.stories.categories');
    Route::get('/success-stories-categories/paging', 'SiteController@successStoriesCategoriesPaging')
        ->name('success.stories.categories.paging');
    Route::get('/success-stories/{cat?}', 'SiteController@successStories')
        ->name('success.stories');
    Route::get('/success-stories/paging/{cat?}', 'SiteController@successStoriesPaging')
        ->name('success.stories.paging');
    Route::get('/success-story/{id?}', 'SiteController@story')
        ->name('story');


    Route::get('/my-test', 'SiteController@myTest')
        ->name('my.test');

});

