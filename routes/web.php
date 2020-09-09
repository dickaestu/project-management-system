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

Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('auth');

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
Route::delete('/my-project/{id}/delete-task', 'BoardController@deleteTask')->name('delete-task')->middleware('auth');

Route::get('/my-project/{id}/project-file', 'ProjectFileController@index')->name('project-file')->middleware('auth');
Route::post('/my-project/{id}/upload-project-file', 'ProjectFileController@store')->name('project-file-upload')->middleware('auth');
Route::get('/my-project/project-file/{file_name}', 'ProjectFileController@download')->name('project-file-download')->middleware('auth');
Route::delete('/my-project/{id}/project-file-delete', 'ProjectFileController@destroy')->name('project-file-delete')->middleware('auth');


Route::get('/my-project/{id}/roadmap', 'RoadmapController@index')->name('project-roadmap')->middleware('auth');
Route::get('/my-project/roadmap/tasks/{id}', 'RoadmapController@getTask')->name('get-task')->middleware('auth');
Route::put('/my-project/roadmap/tasks/edit/{id}', 'RoadmapController@editTask')->name('edit-task')->middleware('auth');

Route::resource('/my-project', 'ProjectController')->middleware('auth');



Auth::routes();
