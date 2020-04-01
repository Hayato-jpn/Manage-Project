<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('top');
});

Route::get('top', function () {
    return view('top');
});

Route::get('goodbye', function () {
    return view('goodbye');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('task/create', 'Admin\TaskController@add')->middleware('auth');
    Route::post('task/create', 'Admin\TaskController@create');
    Route::get('task', 'Admin\TaskController@index')->middleware('auth');
    Route::get('task/edit', 'Admin\TaskController@edit')->middleware('auth');
    Route::post('task/edit', 'Admin\TaskController@update');
    Route::get('task/delete', 'Admin\TaskController@delete')->middleware('auth');
    Route::get('task/finish', 'Admin\TaskController@finish')->middleware('auth');
    Route::get('task/done', 'Admin\TaskController@done')->middleware('auth');
    Route::get('task/renew', 'Admin\TaskController@renew')->middleware('auth');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
