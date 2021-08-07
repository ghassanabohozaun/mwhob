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



