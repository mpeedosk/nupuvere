<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/home', 'PagesController@back');

Route::get('/', 'PagesController@index');

Route::get('/{category}/{age_group}', 'ExerciseController@index');

Route::get('/{category}/{age_group}/{difficulty}/{ex_id}', 'ExerciseController@exercise');