<?php

use Illuminate\Support\Facades\Route;

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

Route::delete('/my-project/delete-member/{id}', 'ProjectController@deleteMember')->name('delete-member');
Route::get('/my-project/cari', 'ProjectController@getUser')->name('cari-user');
Route::post('/my-project/create-member', 'ProjectController@createMember')->name('create-member');

Route::get('/my-project/{id}/board', 'BoardController@index')->name('project-board')->middleware('auth');
Route::get('/my-project/{id}/board/task', 'BoardController@showTask')->name('show-task')->middleware('auth');
Route::post('/my-project/{id}/board/create', 'BoardController@create')->name('create-board')->middleware('auth');
Route::post('/my-project/{id}/board/create-task', 'BoardController@createTask')->name('create-task')->middleware('auth');
Route::get('/my-project/{id}/board/show-create-task', 'BoardController@showCreateTask')->name('show-create-task')->middleware('auth');

Route::put('/my-project/{id}/task/description', 'BoardController@taskDescriptionUpdate')->name('task-description-update')->middleware('auth');
Route::get('/my-project/{id}/task-member', 'BoardController@getMember')->name('cari-member')->middleware('auth');
Route::post('/my-project/create-task-member', 'BoardController@createTaskMember')->name('create-task-member')->middleware('auth');
Route::delete('/my-project/delete-task-member/{id}', 'BoardController@deleteTaskMember')->name('delete-task-member')->middleware('auth');
Route::put('/my-project/change-status-task/{id}', 'BoardController@changeStatus')->name('change-status')->middleware('auth');

Route::get('/my-project/{id}/roadmap', 'RoadmapController@index')->name('project-roadmap')->middleware('auth');

Route::resource('/my-project', 'ProjectController')->middleware('auth');



Auth::routes();
