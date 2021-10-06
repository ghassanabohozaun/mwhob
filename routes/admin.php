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
    Route::post('switch-frontend-lang', 'DashboardController@switchFrontendLang')
        ->name('switch.frontend.lang');

    ///////////////////////////////////////////////////////////////////
    /// Notifications Routes
    Route::group(['prefix'=>'notifications', 'middleware' => 'can:notifications'],function (){
        Route::get('/', 'NotificationsController@index')->name('admin.notifications');
        Route::get('/get-notifications', 'NotificationsController@getNotificationsResource')
            ->name('get.admin.notifications.resource');

        Route::get('/get/admin/notifications', 'NotificationsController@getNotifications')
            ->name('admin.get.notifications');
        Route::get('/get/one/admin/notification', 'NotificationsController@getOneNotification')
            ->name('admin.get.one.notification');
        Route::post('/admin/notification/make/read', 'NotificationsController@makeRead')
            ->name('admin.notification.make.read');
    });
    ///////////////////////////////////////////////////////////////////
    /// Revenues Routes
    Route::group(['prefix' => 'Revenues', 'middleware' => 'can:revenues'], function () {
        Route::get('/', 'RevenuesController@index')->name('admin.revenues');
        Route::get('/get-revenues', 'RevenuesController@getRevenues')->name('admin.get.revenues');
    });

    ///////////////////////////////////////////////////////////////////
    /// Landing Page Routes
    Route::group(['prefix' => 'landing-page', 'middleware' => 'can:landing-page'], function () {

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Sliders routes
        Route::group(['prefix' => 'sliders'], function () {
            Route::get('/', 'SlidersController@index')->name('admin.sliders');
            Route::get('/get-sliders', 'SlidersController@getSliders')->name('get.admin.sliders');
            Route::get('/create', 'SlidersController@create')->name('admin.sliders.create');
            Route::post('/store', 'SlidersController@store')->name('admin.slider.store');
            Route::post('/destroy', 'SlidersController@destroy')->name('admin.slider.destroy');
            Route::get('/edit/{id?}', 'SlidersController@edit')->name('admin.slider.edit');
            Route::post('/update', 'SlidersController@update')->name('admin.slider.update');
            Route::post('/change-status', 'SlidersController@changeStatus')->name('admin.slider.change.status');

        });


        Route::get('/about-mawhob', 'LandingPageController@aboutMawob')->name('admin.about.mawhob');
        Route::post('/about-mawhob', 'LandingPageController@storeAboutMawob')->name('admin.about.mawhob');

        Route::get('/index-page', 'LandingPageController@indexPage')->name('admin.index.page');
        Route::post('/index-page', 'LandingPageController@storeIndexPage')->name('admin.index.page');

        Route::get('/why-choose-us', 'LandingPageController@whyChooseUs')->name('admin.why.choose.us');
        Route::post('/why-choose-us', 'LandingPageController@storeWhyChooseUs')->name('admin.why.choose.us');


        Route::get('/static-strings', 'LandingPageController@staticStrings')->name('admin.static.strings');
        Route::post('/static-strings', 'LandingPageController@storeStaticStrings')->name('admin.static.strings');


        Route::group(['prefix' => 'team'], function () {
            Route::get('/', 'LandingPageController@team')->name('admin.team');
            Route::get('/get-team', 'LandingPageController@getTeam')->name('get.admin.team');
            Route::post('store', 'LandingPageController@storeTeam')->name('admin.store.team');
            Route::post('destroy', 'LandingPageController@destroyTeam')->name('admin.destroy.team');
        });

        Route::group(['prefix' => 'footer-images'], function () {
            Route::get('/', 'LandingPageController@footerImages')->name('admin.footer.images');
            Route::get('/add-footer-images', 'LandingPageController@addFooterImages')
                ->name('admin.add.footer.images');
            Route::post('/upload-footer-images', 'LandingPageController@uploadFooterImages')
                ->name('admin.upload.footer.image');
            Route::post('/delete-footer-images', 'LandingPageController@deleteFooterImages')
                ->name('admin.delete.footer.image');
        });

        Route::get('/registration-policy', 'LandingPageController@registrationPolicy')->name('admin.registration.policy');
        Route::post('/registration-policy', 'LandingPageController@storeRegistrationPolicy')->name('admin.registration.policy');


    });

    //////////////////////////////////////////////////////////////////
    /// admin routes
    Route::get('/admin', 'AdminsController@index')->name('get.admin')->middleware('can:admins');
    Route::get('/get-admin-by-id', 'AdminsController@getAdminById')->name('get.admin.by.id');
    Route::post('/admin-update', 'AdminsController@adminUpdate')->name('admin.update');
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
        Route::get('/create', 'CategoriesController@create')->name('admin.create.category');
        Route::post('/store', 'CategoriesController@store')->name('admin.store.category');
        Route::get('/edit/{id?}', 'CategoriesController@edit')->name('admin.edit.category');
        Route::post('/update', 'CategoriesController@update')->name('admin.update.category');
        Route::post('/destroy', 'CategoriesController@destroy')->name('admin.destroy.category');
        Route::get('/get-all-categories', 'CategoriesController@getAllCategories')->name('admin.get.all.categories');
        Route::get('/get-all-category-name', 'CategoriesController@getAllCategoryName')
            ->name('admin.get.all.category.name');
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
        Route::get('/get-all-mowhobs-name', 'MowhobsController@getAllMowhobName')
            ->name('admin.get.all.mowhobs.name');
    });

    //////////////////////////////////////////////////////////////////
    /// Teachers Routes
    Route::group(['prefix' => 'teachers', 'middleware' => 'can:users'], function () {
        Route::get('/', 'TeacherController@index')->name('admin.teachers');
        Route::get('/get-teachers', 'TeacherController@getTeachers')->name('get.teachers');
        Route::post('/destroy', 'TeacherController@destroy')->name('admin.teacher.destroy');
        Route::post('/change-status', 'TeacherController@changeStatus')->name('admin.teacher.change.status');
        Route::get('/create', 'TeacherController@create')->name('admin.teacher.create');
        Route::post('store', 'TeacherController@store')->name('admin.teacher.store');
        Route::get('/edit/{id?}', 'TeacherController@edit')->name('admin.teacher.edit');
        Route::post('update', 'TeacherController@update')->name('admin.teacher.update');
        Route::get('/trashed-teacher', 'TeacherController@trashedTeacher')->name('admin.teachers.trashed');
        Route::get('/get-trashed-teachers', 'TeacherController@getTrashedTeachers')->name('get.admin.trashed.teachers');
        Route::post('/force-delete', 'TeacherController@forceDelete')->name('admin.teachers.force.delete');
        Route::post('/restore', 'TeacherController@restore')->name('admin.teachers.restore');
        Route::get('/profile/{id?}', 'TeacherController@profile')->name('admin.teacher.profile');
        Route::post('/change-password', 'TeacherController@changePassword')->name('admin.teacher.change.password');
        Route::post('/add-category', 'TeacherController@addCategory')->name('admin.teacher.add.category');
        Route::get('/get-all-teacher-categories', 'TeacherController@getAllTeacherCategories')
            ->name('admin.teacher.get.all.teacher.categories');
        Route::post('/delete-category', 'TeacherController@deleteCategory')
            ->name('admin.delete.teacher.category');
        Route::get('/get-all-teacher-name', 'TeacherController@getAllTeacherName')
            ->name('admin.get.all.teacher.name');

        Route::get('show_teacher/{id}', 'TeacherController@show')->name('show_teacher');

    });


    ///////////////////////////////////////////////////////////////////
    /// Programs Routes
    Route::group(['prefix' => 'programs', 'middleware' => 'can:programs'], function () {
        Route::get('/', 'ProgramsController@index')->name('admin.programs');
        Route::get('/get-programs', 'ProgramsController@getPrograms')->name('admin.get.programs');
        Route::get('/trashed-programs', 'ProgramsController@trashedPrograms')->name('admin.trashed.programs');
        Route::get('/get-trashed-programs', 'ProgramsController@getTrashedPrograms')->name('admin.get.trashed.programs');
        Route::get('/create', 'ProgramsController@create')->name('admin.create.program');
        Route::post('/store', 'ProgramsController@store')->name('admin.store.program');
        Route::get('/edit/{id?}', 'ProgramsController@edit')->name('admin.edit.program');
        Route::post('/update', 'ProgramsController@update')->name('admin.update.program');
        Route::post('/destroy', 'ProgramsController@destroy')->name('admin.destroy.program');
        Route::post('/restore', 'ProgramsController@restore')->name('admin.restore.program');
        Route::post('/force-destroy', 'ProgramsController@forceDestroy')->name('admin.force.destroy.program');
        Route::post('/change-status', 'ProgramsController@changeStatus')->name('program.change.status');

        Route::get('/enrolled-list/{id?}', 'ProgramsController@enrolledList')
            ->name('admin.programs.enrolled.list');
        Route::get('/get-enrolled-list', 'ProgramsController@getEnrolledList')
            ->name('admin.get.programs.enrolled.list');
        Route::post('/store-new-program-mawhob', 'ProgramsController@storeNewProgramMawhob')
            ->name('admin.store.new.program.mawhob');
        Route::post('/destroy-mawhob-from-program', 'ProgramsController@DestroyMawhobFromProgram')
            ->name('admin.destroy.mawhob.from.program');

    });


    ///////////////////////////////////////////////////////////////////
    /// Courses Routes
    Route::group(['prefix' => 'courses', 'middleware' => 'can:courses'], function () {
        Route::get('/', 'CoursesController@index')->name('admin.courses');
        Route::get('/get-courses', 'CoursesController@getCourses')->name('admin.get.courses');
        Route::get('/trashed-courses', 'CoursesController@trashedCourses')->name('admin.trashed.courses');
        Route::get('/get-trashed-courses', 'CoursesController@getTrashedCourses')->name('admin.get.trashed.courses');
        Route::get('/create', 'CoursesController@create')->name('admin.create.course');
        Route::post('/store', 'CoursesController@store')->name('admin.store.course');
        Route::get('/edit/{id?}', 'CoursesController@edit')->name('admin.edit.course');
        Route::post('/update', 'CoursesController@update')->name('admin.update.course');
        Route::post('/destroy', 'CoursesController@destroy')->name('admin.destroy.course');
        Route::post('/restore', 'CoursesController@restore')->name('admin.restore.course');
        Route::post('/force-destroy', 'CoursesController@forceDestroy')->name('admin.force.destroy.course');
        Route::post('/change-status', 'CoursesController@changeStatus')->name('course.change.status');
        Route::post('/change-active', 'CoursesController@changeActive')->name('course.change.active');
        Route::post('/change-teacher-of-course', 'CoursesController@changeTeacherOfCourse')
            ->name('admin.change.teacher.of.course');
        Route::get('/show-course-details', 'CoursesController@showCourseDetails')
            ->name('admin.show.course.details');


        Route::get('/enrolled-list/{id?}', 'CoursesController@enrolledList')
            ->name('admin.courses.enrolled.list');
        Route::get('/get-enrolled-list', 'CoursesController@getEnrolledList')
            ->name('admin.get.courses.enrolled.list');
        Route::post('/store-new-course-mawhob', 'CoursesController@storeNewCourseMawhob')
            ->name('admin.store.new.course.mawhob');
        Route::post('/destroy-mawhob-from-course', 'CoursesController@DestroyMawhobFromCourse')
            ->name('admin.destroy.mawhob.from.course');


        ///////////////////////////////////////////////////////////////////
        /// Lectures Routes
        Route::group(['prefix' => 'lectures', 'middleware' => 'can:courses'], function () {
            Route::get('/lecture/{id?}', 'LecturesController@index')->name('admin.lectures');
            Route::get('/get-lectures/{id?}', 'LecturesController@getLectures')->name('admin.get.lectures');
            Route::get('/create', 'LecturesController@create')->name('admin.create.lecture');
            Route::post('/store', 'LecturesController@store')->name('admin.store.lecture');
            Route::get('/edit/{id?}', 'LecturesController@edit')->name('admin.edit.lecture');
            Route::post('/update', 'LecturesController@update')->name('admin.update.lecture');
            Route::post('/destroy', 'LecturesController@destroy')->name('admin.destroy.lecture');
            Route::post('/change-status', 'LecturesController@changeStatus')
                ->name('admin.lecture.change.status');
        });
    });


    ///////////////////////////////////////////////////////////////////
    /// Summer Camps Routes
    Route::group(['prefix' => 'summer-camps', 'middleware' => 'can:activities'], function () {
        Route::get('/', 'SummerCampsController@index')->name('admin.summer.camps');
        Route::get('/get-summer-camps', 'SummerCampsController@getSummerCamps')->name('admin.get.summer.camps');
        Route::get('/trashed-summer-camps', 'SummerCampsController@trashedSummerCamps')->name('admin.trashed.summer.camps');
        Route::get('/get-trashed-summer-camps', 'SummerCampsController@getTrashedSummerCamps')->name('admin.get.trashed.summer.camps');
        Route::get('/create', 'SummerCampsController@create')->name('admin.create.summer.camp');
        Route::post('/store', 'SummerCampsController@store')->name('admin.store.summer.camp');
        Route::get('/edit/{id?}', 'SummerCampsController@edit')->name('admin.edit.summer.camp');
        Route::post('/update', 'SummerCampsController@update')->name('admin.update.summer.camp');
        Route::post('/destroy', 'SummerCampsController@destroy')->name('admin.destroy.summer.camp');
        Route::post('/restore', 'SummerCampsController@restore')->name('admin.restore.summer.camp');
        Route::post('/force-destroy', 'SummerCampsController@forceDestroy')->name('admin.force.destroy.summer.camp');
        Route::post('/change-status', 'SummerCampsController@changeStatus')->name('summer.camp.change.status');

    });


    ///////////////////////////////////////////////////////////////////
    /// Contests Routes
    Route::group(['prefix' => 'contests', 'middleware' => 'can:activities'], function () {
        Route::get('/', 'ContestsController@index')->name('admin.contests');
        Route::get('/get-contests', 'ContestsController@getContests')->name('admin.get.contests');
        Route::get('/trashed-contests', 'ContestsController@trashedContests')->name('admin.trashed.contests');
        Route::get('/get-trashed-contests', 'ContestsController@getTrashedContests')->name('admin.get.trashed.contests');
        Route::get('/create', 'ContestsController@create')->name('admin.create.contest');
        Route::post('/store', 'ContestsController@store')->name('admin.store.contest');
        Route::get('/edit/{id?}', 'ContestsController@edit')->name('admin.edit.contest');
        Route::post('/update', 'ContestsController@update')->name('admin.update.contest');
        Route::post('/destroy', 'ContestsController@destroy')->name('admin.destroy.contest');
        Route::post('/restore', 'ContestsController@restore')->name('admin.restore.contest');
        Route::post('/force-destroy', 'ContestsController@forceDestroy')->name('admin.force.destroy.contest');
        Route::post('/change-status', 'ContestsController@changeStatus')->name('contest.change.status');
        Route::post('/renew-contest', 'ContestsController@renewContest')->name('admin.renew.contest');
        Route::get('/enrolled-list/{id?}', 'ContestsController@enrolledList')
            ->name('admin.contests.enrolled.list');
        Route::get('/get-enrolled-list', 'ContestsController@getEnrolledList')
            ->name('admin.get.contests.enrolled.list');
        Route::post('/store-new-contest-mawhob', 'ContestsController@storeNewContestMawhob')
            ->name('admin.store.new.contest.mawhob');
        Route::post('/destroy-mawhob-from-contest', 'ContestsController@DestroyMawhobFromContest')
            ->name('admin.destroy.mawhob.from.contest');

        Route::post('/choose-contest-winner', 'ContestsController@chooseContestWinner')
            ->name('admin.choose.contest.winner');

    });


    ///////////////////////////////////////////////////////////////////
    /// Sounds Routes
    Route::group(['prefix' => 'sounds', 'middleware' => 'can:talents'], function () {
        Route::get('/', 'SoundsController@index')->name('admin.sounds');
        Route::get('/get-sounds', 'SoundsController@getSounds')->name('admin.get.sounds');
        Route::get('/trashed-sounds', 'SoundsController@trashedSounds')->name('admin.trashed.sounds');
        Route::get('/get-trashed-sounds', 'SoundsController@getTrashedSounds')->name('admin.get.trashed.sounds');
        Route::get('/create', 'SoundsController@create')->name('admin.create.sound');
        Route::post('/store', 'SoundsController@store')->name('admin.store.sound');
        Route::get('/edit/{id?}', 'SoundsController@edit')->name('admin.edit.sound');
        Route::post('/update', 'SoundsController@update')->name('admin.update.sound');
        Route::post('/destroy', 'SoundsController@destroy')->name('admin.destroy.sound');
        Route::post('/restore', 'SoundsController@restore')->name('admin.restore.sound');
        Route::post('/force-destroy', 'SoundsController@forceDestroy')->name('admin.force.destroy.sound');
        Route::post('/change-status', 'SoundsController@changeStatus')->name('admin.sound.change.status');
        Route::get('/view_sound', 'SoundsController@viewSound')->name('admin.sound.view');

    });

    ///////////////////////////////////////////////////////////////////
    /// Videos Routes
    Route::group(['prefix' => 'videos', 'middleware' => 'can:talents'], function () {
        Route::get('/', 'VideosController@index')->name('admin.videos');
        Route::get('/get-videos', 'VideosController@getVideos')->name('admin.get.videos');
        Route::get('/trashed-videos', 'VideosController@trashedVideos')->name('admin.trashed.videos');
        Route::get('/get-trashed-videos', 'VideosController@getTrashedVideos')->name('admin.get.trashed.videos');
        Route::get('/create', 'VideosController@create')->name('admin.create.video');
        Route::post('/store', 'VideosController@store')->name('admin.store.video');
        Route::get('/edit/{id?}', 'VideosController@edit')->name('admin.edit.video');
        Route::post('/update', 'VideosController@update')->name('admin.update.video');
        Route::post('/destroy', 'VideosController@destroy')->name('admin.destroy.video');
        Route::post('/restore', 'VideosController@restore')->name('admin.restore.video');
        Route::post('/force-destroy', 'VideosController@forceDestroy')->name('admin.force.destroy.video');
        Route::post('/change-status', 'VideosController@changeStatus')->name('admin.video.change.status');
        Route::get('/view-video', 'VideosController@viewVideo')->name('admin.video.view');
    });


    ///////////////////////////////////////////////////////////////////
    /// Story Categories Routes
    Route::group(['prefix' => 'story-categories', 'middleware' => 'can:talents'], function () {
        Route::get('/', 'StoryCategoriesController@index')->name('admin.story.categories');
        Route::get('/get-story-categories', 'StoryCategoriesController@getStroyCategories')->name('admin.get.story.categories');
        Route::get('/create', 'StoryCategoriesController@create')->name('admin.create.story.category');
        Route::post('/store', 'StoryCategoriesController@store')->name('admin.store.story.category');
        Route::get('/edit/{id?}', 'StoryCategoriesController@edit')->name('admin.edit.story.category');
        Route::post('/update', 'StoryCategoriesController@update')->name('admin.update.story.category');
        Route::post('/destroy', 'StoryCategoriesController@destroy')->name('admin.destroy.story.category');
        Route::get('/get-all-story-categories', 'StoryCategoriesController@getAllStoryCategories')->name('admin.get.all.story.categories');
        Route::get('/get-all-story-category-name', 'StoryCategoriesController@getAllStoryCategoryName')
            ->name('admin.get.all.story-category.name');
    });


    ///////////////////////////////////////////////////////////////////
    /// success Stories Routes
    Route::group(['prefix' => 'stories', 'middleware' => 'can:talents'], function () {
        Route::get('/', 'StoriesController@index')->name('admin.stories');
        Route::get('/get-stories', 'StoriesController@getStories')->name('admin.get.stories');
        Route::get('/trashed-stories', 'StoriesController@trashedStories')->name('admin.trashed.stories');
        Route::get('/get-trashed-stories', 'StoriesController@getTrashedStories')->name('admin.get.trashed.stories');
        Route::get('/create', 'StoriesController@create')->name('admin.create.story');
        Route::post('/store', 'StoriesController@store')->name('admin.store.story');
        Route::get('/edit/{id?}', 'StoriesController@edit')->name('admin.edit.story');
        Route::post('/update', 'StoriesController@update')->name('admin.update.story');
        Route::post('/destroy', 'StoriesController@destroy')->name('admin.destroy.story');
        Route::post('/restore', 'StoriesController@restore')->name('admin.restore.story');
        Route::post('/force-destroy', 'StoriesController@forceDestroy')->name('admin.force.destroy.story');
        Route::post('/change-status', 'StoriesController@changeStatus')->name('story.change.status');
        Route::get('/show-story-details', 'StoriesController@showStoryDetails')
            ->name('admin.show.story.details');
        Route::get('/get-all-mawhob-experiences', 'StoriesController@getAllMawhobExperiences')
            ->name('admin.get.all.mawhob.experiences');
    });

});


//////////////////////////////////////////////////////////////////////////////
/// Guest => that mean:must not be admin => because any one must be able to access login page
Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'LoginController@getLogin')->name('get.admin.login');
    Route::post('login', 'LoginController@doLogin')->name('admin.login');

    Route::get('/login2', function () {
        return view('admin.auth.login2');
    });


});
//////////////////////////////////////////////////////////////////////////////
/// Logout
Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');



