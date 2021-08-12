<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
/*
Auth::routes();
*/

//////////////////////////////////////////////////////////
/// Student Login until create Student Routes File
Route::group(['prefix' => 'student'], function () {
    Route::get('/login', function () {
        return view('site.student.auth.login');
    })->name('get.student.login');
});


Route::get('/panels', function () {

    return view('panels');
});



Route::get('sms', 'PhoneAuthController@sms');

Route::get('verify/{coderesult?}', 'PhoneAuthController@verify')->name('verify');


