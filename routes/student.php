<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Students Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'Student',
    'middleware' => ['auth:student', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {


    //////////////////////////////////////////////////////////////////
    /// not found page
     //Route::get('/notFound', 'DashboardController@notFound')->name('student.not.found');

    Route::get('/portfolio', 'DashboardController@portfolio')->name('student.portfolio');

    Route::get('/courses', 'DashboardController@courses')->name('student.courses');
    Route::get('/student/courses/paging', 'DashboardController@studentCoursePaging')
        ->name('student.courses.paging');

    Route::get('/get-course/{id?}', 'DashboardController@getStudentCourse')->name('get.student.course');

    Route::get('/contests', 'DashboardController@contests')->name('student.contests');
    Route::get('/student/contests/paging', 'DashboardController@studentContestsPaging')
        ->name('student.contests.paging');

    Route::get('/contest-registration-terms/{id?}', 'StudentController@contestRegistrationTerms')
        ->name('student.contest.registration.terms');


    Route::get('/programs', 'DashboardController@programs')->name('student.programs');
    Route::get('/student/programs/paging', 'DashboardController@studentProgramsPaging')
        ->name('student.programs.paging');

    Route::get('/student/show/all/notifications', 'DashboardController@showAllStudentNotifications')
        ->name('student.show.all.notifications');

    Route::get('/student/show/all/notifications/paging', 'DashboardController@showAllStudentNotificationsPaging')
        ->name('student.notifications.paging');

    Route::get('/update-account', 'DashboardController@updateAccount')->name('student.update.account');
    Route::post('/update-account', 'DashboardController@updateStudentAccount')->name('student.update.account');

    Route::post('/student-enroll-contest', 'StudentController@enrollContest')->name('student.enroll.contest');
    Route::post('/student-enroll-course', 'StudentController@enrollCourse')->name('student.enroll.course');
    Route::post('/student-enroll-program', 'StudentController@enrollProgram')->name('student.enroll.program');
    Route::post('/student-attendance-enroll-in-lecture', 'StudentController@studentAttendanceEnrollInLecture')
        ->name('student.attendance.enroll.in.lecture');




    ///////////////////////////////////////////////////////////////////
    /// Notifications Routes
    Route::group(['prefix'=>'notifications'],function (){

        Route::get('/get/student/notifications', 'NotificationsController@getNotifications')
            ->name('student.get.notifications');

        Route::get('/get/one/student/notification', 'NotificationsController@getOneNotification')
            ->name('student.get.one.notification');

        Route::post('/student/notification/make/read', 'NotificationsController@makeRead')
            ->name('student.notification.make.read');
    });

});


//////////////////////////////////////////////////////////////////////////////
/// Guest => that mean:must not be student => because any one must be able to access login page
Route::group(['namespace' => 'Student', 'middleware' => 'guest:student'], function () {



    Route::get('/registration-policy', 'SignupController@registrationPolicy')
        ->name('student.registration.policy');


    Route::group(['prefix' => 'signup'], function () {
        Route::get('/', 'SignupController@index')->name('student.signup');
        Route::post('/store', 'SignupController@store')->name('student.signup.store');
    });

    Route::get('/mobile-confirm/{mobileNo?}/{whatsappNo?}', 'SignupController@registrationConfirmation')
        ->name('student.registration.confirmation');

    Route::post('/active-student', 'SignupController@activeStudent')
        ->name('student.active.student');

    Route::get('login', 'StudentLoginController@getLogin')->name('get.student.login');
    Route::post('login', 'StudentLoginController@doLogin')->name('student.login');


});

//////////////////////////////////////////////////////////////////////////////
/// Logout
Route::get('logout', 'Student\StudentLoginController@logout')->name('student.logout');
