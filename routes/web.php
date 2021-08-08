<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
/*
Auth::routes();
*/




Route::get('/panels',function (){

    return view('panels');
});


Route::get('/teacher',function (){

    return view('teacher.dashboard');
});


