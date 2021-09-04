<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/
////////////////////////////////////////////////////////////////////////
/// auth  => that mean : must be teacher and login
///

Route::group([
    'namespace' => 'Teacher',
    'middleware' => ['auth:teacher', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    //////////////////////////////////////////////////////////////////
    /// not found page
    Route::get('/notFound', 'DashboardController@notFound')->name('teacher.not.found');
    //////////////////////////////////////////////////////////////////
    /// dashboard
    Route::get('/', 'DashboardController@index')->name('teacher.dashboard');
    Route::get('/dashboard', 'DashboardController@index')->name('teacher.dashboard');


    Route::get('/teacher-profile', 'DashboardController@profile')->name('teacher.profile');

    ///////////////////////////////////////////////////////////////////
    /// Courses Routes
    Route::group(['prefix' => 'courses'], function () {
        Route::get('/', 'CoursesController@index')->name('teacher.courses');
        Route::get('/get-courses', 'CoursesController@getCourses')->name('teacher.get.courses');
        Route::get('/trashed-courses', 'CoursesController@trashedCourses')->name('teacher.trashed.courses');
        Route::get('/get-trashed-courses', 'CoursesController@getTrashedCourses')->name('teacher.get.trashed.courses');
        Route::get('/create', 'CoursesController@create')->name('teacher.create.course');
        Route::post('/store', 'CoursesController@store')->name('teacher.store.course');
        Route::get('/edit/{id?}', 'CoursesController@edit')->name('teacher.edit.course');
        Route::post('/update', 'CoursesController@update')->name('teacher.update.course');
        Route::post('/destroy', 'CoursesController@destroy')->name('teacher.destroy.course');
        Route::post('/restore', 'CoursesController@restore')->name('teacher.restore.course');
        Route::post('/force-destroy', 'CoursesController@forceDestroy')->name('teacher.force.destroy.course');
        Route::post('/change-status', 'CoursesController@changeStatus')->name('teacher.course.change.status');
        Route::post('/change-active', 'CoursesController@changeActive')->name('teacher.course.change.active');
        Route::post('/change-teacher-of-course', 'CoursesController@changeTeacherOfCourse')
            ->name('teacher.change.teacher.of.course');
        Route::get('/show-course-details', 'CoursesController@showCourseDetails')
            ->name('teacher.show.course.details');




    });

});

//////////////////////////////////////////////////////////////////////////////
/// Guest => that mean:must not be teacher => because any one must be able to access login page
Route::group(['namespace' => 'Teacher', 'middleware' => 'guest:teacher'], function () {
    Route::get('login', 'LoginController@getLogin')->name('get.teacher.login');
    Route::post('login', 'LoginController@doLogin')->name('teacher.login');
});

//////////////////////////////////////////////////////////////////////////////
/// Logout
Route::get('logout', 'Teacher\LoginController@logout')->name('teacher.logout');




