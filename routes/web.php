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

Route::group(['middleware' => 'admin'], function () {

    Route::get('admin', 'AdminController@index');
    Route::get('admin/home', 'AdminController@home');
    Route::get('admin/category', 'AdminController@category');
    Route::get('admin/exercise', 'AdminController@exercise');
    Route::get('admin/highscore', 'AdminController@home');
    Route::get('admin/admins', 'AdminController@home');

    Route::post('admin/upload/gallery', 'AdminController@updateGallery');
    Route::post('admin/upload/logo', 'AdminController@updateLogos');
    Route::post('admin/upload', 'AdminController@upload');

    Route::post('categories/add', 'CategoryController@create');
    Route::patch('categories/update', 'CategoryController@update');
    Route::delete('categories/delete/{id}', 'CategoryController@destroy');

    Route::get('exercise/text','ExerciseController@getTextual');
    Route::get('exercise/choice','ExerciseController@getChoice');
    Route::get('exercise/multiple','ExerciseController@getMultiple');
    Route::get('exercise/order','ExerciseController@getOrder');

    Route::get('exercise/edit/{id}', 'ExerciseController@edit');
    Route::delete('exercise/delete/{id}', 'ExerciseController@destroy');

    Route::post('exercise/text/create', 'ExerciseController@createTextual');
    Route::get('exercise/text/edit/{id}', 'ExerciseController@getTextualForEdit');
    Route::patch('exercise/text/edit/{id}', 'ExerciseController@updateTextual');

});

Route::group(['middleware' => 'auth'], function () {
    Route::post('exercise/check/{id}', 'AnswerController@checkAnswer');
    Route::post('exercise/show/{id}', 'AnswerController@showAnswer');
});


Route::get('{category}/{age_group}', 'ExerciseController@index');
Route::get('{category}/{age_group}/{difficulty}/{ex_id}', 'ExerciseController@exercise');

