<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
////////////////////////////////////////////////////////////////////////
/// auth  => that mean : must be admin and login
///

Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    //////////////////////////////////////////////////////////////////
    /// not found page
    Route::get('/notFound', 'DashboardController@notFound')->name('admin.not.found');
    //////////////////////////////////////////////////////////////////
    /// dashboard
    Route::get('/', 'DashboardController@index')->name('admin.dashboard')->middleware('can:dashboard');
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard')->middleware('can:dashboard');
    //////////////////////////////////////////////////////////////////
    /// settings
    Route::get('settings', 'DashboardController@getSettings')
        ->name('get.admin.settings')->middleware('can:settings');
    Route::post('settings', 'DashboardController@storeSettings')
        ->name('store.admin.settings')->middleware('can:settings');
    Route::post('switch-en-lang', 'DashboardController@switchEnglishLang')
        ->name('switch.english.lang');
    //////////////////////////////////////////////////////////////////
    /// Support Center Route
    Route::group(['prefix' => 'support-center', 'middleware' => 'can:support-center'], function () {
        Route::get('/', 'SupportCenterController@index')
            ->name('admin.support.center');
        Route::get('/get-support-center', 'SupportCenterController@getSupportCenter')
            ->name('get.admin.support.center');
        Route::get('/create', 'SupportCenterController@create')
            ->name('admin.support.center.create');
        Route::post('/send', 'SupportCenterController@send')
            ->name('admin.support.center.send');
        Route::post('/change-status', 'SupportCenterController@changeStatus')
            ->name('admin.support.center.change.status');

        Route::get('/get-one-message', 'SupportCenterController@getOneMessage')
            ->name('admin.support.center.get.one.message');
    });
    //////////////////////////////////////////////////////////////////
    /// admin routes
    Route::get('/admin', 'AdminsController@index')->name('get.admin')->middleware('can:admins');
    Route::get('/get-admin-by-id', 'AdminsController@getAdminById')->name('get.admin.by.id');
    Route::post('/admin-update', 'AdminsController@adminUpdate')->name('admin.update');
    //////////////////////////////////////////////////////////////////
    /// users Routes
    Route::group(['prefix' => 'users', 'middleware' => 'can:users'], function () {
        Route::get('/', 'UserController@index')->name('users');
        Route::get('/get-users', 'UserController@getUsers')->name('get.users');
        Route::post('/destroy', 'UserController@destroy')->name('user.destroy');
        Route::post('/change-status', 'UserController@changeStatus')->name('user.change.status');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('store', 'UserController@store')->name('user.store');
        Route::get('/edit/{id?}', 'UserController@edit')->name('user.edit');
        Route::post('update', 'UserController@update')->name('user.update');
        Route::get('/trashed-user', 'UserController@trashedUser')->name('users.trashed');
        Route::get('/get-trashed-users', 'UserController@getTrashedUsers')->name('get.trashed.users');
        Route::post('/force-delete', 'UserController@forceDelete')->name('user.force.delete');
        Route::post('/restore', 'UserController@restore')->name('user.restore');
        Route::get('/bar-chart', 'UserController@barChart')->name('user.bar.chart');

    });
    ///////////////////////////////////////////////////////////////////
    /// Roles Routes
    Route::group(['prefix' => 'roles', 'middleware' => 'can:roles'], function () {
        Route::get('/', 'RolesController@index')->name('admin.roles');
        Route::get('/get-roles', 'RolesController@getRoles')->name('get.admin.roles');
        Route::get('/create', 'RolesController@create')->name('admin.role.create');
        Route::post('/store', 'RolesController@store')->name('admin.role.store');
        Route::post('/destroy', 'RolesController@destroy')->name('admin.role.destroy');
        Route::get('/edit/{id?}', 'RolesController@edit')->name('admin.role.edit');
        Route::post('/update', 'RolesController@update')->name('admin.role.update');
    });
    ///////////////////////////////////////////////////////////////////
    /// Categories Routes
    Route::group(['prefix' => 'categories', 'middleware' => 'can:categories'], function () {
        Route::get('/', 'CategoriesController@index')->name('admin.categories');
        Route::get('/get-categories', 'CategoriesController@getCategories')->name('admin.get.categories');
        Route::get('/trashed-categories', 'CategoriesController@trashedCategories')->name('admin.trashed.categories');
        Route::get('/get-trashed-categories', 'CategoriesController@getTrashedCategories')->name('admin.get.trashed.categories');
        Route::get('/create', 'CategoriesController@create')->name('admin.create.category');
        Route::post('/store', 'CategoriesController@store')->name('admin.store.category');
        Route::get('/edit/{id?}', 'CategoriesController@edit')->name('admin.edit.category');
        Route::post('/update', 'CategoriesController@update')->name('admin.update.category');
        Route::post('/destroy', 'CategoriesController@destroy')->name('admin.destroy.category');
        Route::post('/restore', 'CategoriesController@restore')->name('admin.restore.category');
        Route::post('/force-destroy', 'CategoriesController@forceDestroy')->name('admin.force.destroy.category');
        Route::get('/get-all-categories', 'CategoriesController@getAllCategories')->name('admin.get.all.categories');

    });

    //////////////////////////////////////////////////////////////////
    /// mowhobs Routes
    Route::group(['prefix' => 'mowhobs', 'middleware' => 'can:users'], function () {
        Route::get('/', 'MowhobsController@index')->name('admin.mowhobs');
        Route::get('/get-mowhobs', 'MowhobsController@getMowhobs')->name('get.mowhobs');
        Route::post('/destroy', 'MowhobsController@destroy')->name('mowhob.destroy');
        Route::post('/change-status', 'MowhobsController@changeStatus')->name('mowhob.change.status');
        Route::get('/create', 'MowhobsController@create')->name('mowhob.create');
        Route::post('store', 'MowhobsController@store')->name('mowhob.store');
        Route::get('/edit/{id?}', 'MowhobsController@edit')->name('mowhob.edit');
        Route::post('update', 'MowhobsController@update')->name('mowhob.update');
        Route::get('/trashed-mowhob', 'MowhobsController@trashedMowhob')->name('mowhobs.trashed');
        Route::get('/get-trashed-mowhobs', 'MowhobsController@getTrashedMowhobs')->name('get.trashed.mowhobs');
        Route::post('/force-delete', 'MowhobsController@forceDelete')->name('mowhobs.force.delete');
        Route::post('/restore', 'MowhobsController@restore')->name('mowhobs.restore');
        Route::get('/profile/{id?}', 'MowhobsController@profile')->name('mowhob.profile');

    });

    //////////////////////////////////////////////////////////////////
    /// Teachers Routes
    Route::group(['prefix' => 'teachers', 'middleware' => 'can:users'], function () {
        Route::get('/', 'TeacherController@index')->name('admin.teachers');
        Route::get('/get-teachers', 'TeacherController@getTeachers')->name('get.teachers');
        Route::post('/destroy', 'TeacherController@destroy')->name('teacher.destroy');
        Route::post('/change-status', 'TeacherController@changeStatus')->name('teacher.change.status');
        Route::get('/create', 'TeacherController@create')->name('teacher.create');
        Route::post('store', 'TeacherController@store')->name('teacher.store');
        Route::get('/edit/{id?}', 'TeacherController@edit')->name('teacher.edit');
        Route::post('update', 'TeacherController@update')->name('teacher.update');
        Route::get('/trashed-teacher', 'TeacherController@trashedTeacher')->name('teachers.trashed');
        Route::get('/get-trashed-teachers', 'TeacherController@getTrashedTeachers')->name('get.trashed.teachers');
        Route::post('/force-delete', 'TeacherController@forceDelete')->name('teachers.force.delete');
        Route::post('/restore', 'TeacherController@restore')->name('teachers.restore');
        Route::get('/profile/{id?}', 'TeacherController@profile')->name('teacher.profile');
        Route::post('/change-password', 'TeacherController@changePassword')->name('teacher.change.password');
        Route::post('/add-category', 'TeacherController@addCategory')->name('teacher.add.category');
        Route::get('/get-all-teacher-categories', 'TeacherController@getAllTeacherCategories')
            ->name('teacher.get.all.teacher.categories');

        Route::post('/delete-category','TeacherController@deleteCategory')
            ->name('admin.delete.teacher.category');
    });

});

//////////////////////////////////////////////////////////////////////////////
/// Guest => that mean:must not be admin => because any one must be able to access login page
Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'LoginController@getLogin')->name('get.admin.login');
    Route::post('login', 'LoginController@doLogin')->name('admin.login');
});
//////////////////////////////////////////////////////////////////////////////
/// Logout
Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');



