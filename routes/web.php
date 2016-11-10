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


    // EXERCICE CONTROLLER NEEDS REFACTORING!


    Route::get('admin/exercise/create/{type}', 'ExerciseController@showExerciseTemplate');
    Route::post('admin/exercise/create/{type}', 'ExerciseController@create');
    Route::get('admin/exercise/edit/{id}', 'ExerciseController@getExerciseForEdit');
    Route::patch('admin/exercise/edit/{id}', 'ExerciseController@update');
    Route::delete('exercise/delete/{id}', 'ExerciseController@destroy');



});

Route::group(['middleware' => 'auth'], function () {
    Route::post('answer/check/{ex_id}', 'AnswerController@checkAnswer');
    Route::post('answer/show/{ex_id}', 'AnswerController@showAnswer');
});


Route::get('{category}/{age_group}', 'ExerciseController@showExerciseList');
Route::get('{category}/{age_group}/{difficulty}/{ex_id}', 'ExerciseController@show');

