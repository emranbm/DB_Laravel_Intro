<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->middleware('guest');

    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::delete('/delete_task/{task}', 'TaskController@destroy');
    Route::get('/task_done/{task}', 'TaskController@task_done');
    Route::get('/task_todo/{task}', 'TaskController@task_todo');
    Route::get('/task_doing/{task}', 'TaskController@task_doing');

    Route::auth();

    Route::get('/ehsan/{id}', 'TaskController@ehsan');

});
