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




    //////////////////////////////////////////////////////////////////
    /// teacher  routes
    Route::get('/teacher', 'TeacherController@index')->name('get.teacher');
    Route::get('/get-teacher-by-id', 'TeacherController@getTeacherById')->name('get.teacher.by.id');
    Route::post('/teacher-update', 'TeacherController@teacherUpdate')->name('teacher.update');



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



