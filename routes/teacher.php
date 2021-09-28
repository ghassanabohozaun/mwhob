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
    Route::get('/', 'DashboardController@profile')->name('teacher.dashboard');

    Route::get('/teacher-profile', 'DashboardController@profile')
        ->name('teacher.profile');
    Route::post('/delete-category', 'DashboardController@deleteCategory')
        ->name('teacher.delete.teacher.category');


    ///////////////////////////////////////////////////////////////////
    /// Notifications Routes
    ///////////////////////////////////////////////////////////////////
    /// Notifications Routes
    Route::group(['prefix'=>'notifications'],function (){

        Route::get('/', 'NotificationsController@index')->name('teacher.notifications');
        Route::get('/get-notifications', 'NotificationsController@getNotificationsResource')
            ->name('get.teacher.notifications.resource');


    Route::get('/get/teacher/notifications', 'NotificationsController@getNotifications')
        ->name('teacher.get.notifications');
    Route::get('/get/one/teacher/notification', 'NotificationsController@getOneNotification')
        ->name('teacher.get.one.notification');
    Route::post('/teacher/notification/make/read', 'NotificationsController@makeRead')
        ->name('teacher.notification.make.read');
    });
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


        ///////////////////////////////////////////////////////////////////
        /// Lectures Routes
        Route::group(['prefix' => 'lectures'], function () {
            Route::get('/lecture/{id?}', 'LecturesController@index')->name('teacher.lectures');
            Route::get('/get-lectures/{id?}', 'LecturesController@getLectures')->name('teacher.get.lectures');
            Route::get('/create', 'LecturesController@create')->name('teacher.create.lecture');
            Route::post('/store', 'LecturesController@store')->name('teacher.store.lecture');
            Route::get('/edit/{id?}', 'LecturesController@edit')->name('teacher.edit.lecture');
            Route::post('/update', 'LecturesController@update')->name('teacher.update.lecture');
            Route::post('/destroy', 'LecturesController@destroy')->name('teacher.destroy.lecture');
            Route::post('/change-status', 'LecturesController@changeStatus')
                ->name('teacher.lecture.change.status');
        });


    });

});

//////////////////////////////////////////////////////////////////////////////
/// Guest => that mean:must not be teacher => because any one must be able to access login page
Route::group(['namespace' => 'Teacher', 'middleware' => 'guest:teacher'], function () {
    Route::get('login', 'TeacherLoginController@getLogin')->name('get.teacher.login');
    Route::post('login', 'TeacherLoginController@doLogin')->name('teacher.login');
});

//////////////////////////////////////////////////////////////////////////////
/// Logout
Route::get('logout', 'Teacher\TeacherLoginController@logout')->name('teacher.logout');




