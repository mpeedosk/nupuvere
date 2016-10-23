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


Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@back');


Route::get('/admin', 'AdminController@index');
Route::get('/admin/home', 'AdminController@home');
Route::post('/admin/upload/gallery', 'AdminController@updateGallery');
Route::post('/admin/upload/logo', 'AdminController@updateLogos');


Route::post('/exercise/check/{id}', 'UserController@checkAnswer');
Route::post('/exercise/show/{id}', 'UserController@showAnswer');

Route::get('/{category}/{age_group}', 'ExerciseController@index');
Route::get('/{category}/{age_group}/{difficulty}/{ex_id}', 'ExerciseController@exercise');

