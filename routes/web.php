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



Route::middleware(['auth', 'member'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');


        Route::delete('/my-project/delete-member/{id}', 'ProjectController@deleteMember')->name('delete-member');
        Route::get('/my-project/cari', 'ProjectController@getUser')->name('cari-user');
        Route::post('/my-project/create-member', 'ProjectController@createMember')->name('create-member');

        // Board
        Route::get('/my-project/{id}/board', 'BoardController@index')->name('project-board');
        Route::put('/my-project/board/{id}/edit', 'BoardController@editBoard')->name('edit-board');
        Route::get('/my-project/{id}/board/task', 'BoardController@showTask')->name('show-task');
        Route::post('/my-project/{id}/board/create', 'BoardController@create')->name('create-board');
        Route::post('/my-project/{id}/board/create-task', 'BoardController@createTask')->name('create-task');
        Route::get('/my-project/{id}/board/show-create-task', 'BoardController@showCreateTask')->name('show-create-task');
        Route::delete('/my-project/{id}/board/delete', 'BoardController@deleteBoard')->name('delete-board');

        // Task
        Route::put('/my-project/{id}/task/name', 'BoardController@taskNameEdit')->name('edit-task-name');
        Route::put('/my-project/{id}/task/description', 'BoardController@taskDescriptionUpdate')->name('task-description-update');
        Route::get('/my-project/{id}/task-member', 'BoardController@getMember')->name('cari-member');
        Route::post('/my-project/create-task-member', 'BoardController@createTaskMember')->name('create-task-member');
        Route::delete('/my-project/delete-task-member/{id}', 'BoardController@deleteTaskMember')->name('delete-task-member');
        Route::put('/my-project/change-status-task/{id}', 'BoardController@changeStatus')->name('change-status');
        Route::put('/my-project/change-tags/{id}', 'BoardController@changeTags')->name('change-tags');
        Route::delete('/my-project/{id}/delete-task', 'BoardController@deleteTask')->name('delete-task');
        Route::delete('/my-project/{id}/archive-task', 'BoardController@archiveTask')->name('archive-task');
        Route::post('/my-project/{id}/upload-task-file', 'BoardController@uploadFileTask')->name('upload-file-task');
        Route::get('/my-project/download-task-file/{id}', 'BoardController@downloadFileTask')->name('download-file-task');
        Route::delete('/my-project/delete-task-file/{id}', 'BoardController@deleteFileTask')->name('delete-file-task');
        Route::post('/my-project/{id}/sub-task', 'BoardController@storeSubTask')->name('add-sub-task');
        Route::get('/my-project/status-sub-task/{id}', 'BoardController@changeStatusSubTask')->name('change-status-sub-task');
        Route::delete('/my-project/delete-sub-task/{id}', 'BoardController@deleteSubTask')->name('delete-sub-task');
        Route::post('/my-project/{id}/add-comment', 'BoardController@addComment')->name('add-comment');
        Route::delete('/my-project/comment/delete/{id}', 'BoardController@deleteComment')->name('delete-comment');

        // Project File
        Route::get('/my-project/{id}/project-file', 'ProjectFileController@index')->name('project-file');
        Route::post('/my-project/{id}/upload-project-file', 'ProjectFileController@store')->name('project-file-upload');
        Route::get('/my-project/project-file/{id}', 'ProjectFileController@download')->name('project-file-download');
        Route::delete('/my-project/{id}/project-file-delete', 'ProjectFileController@destroy')->name('project-file-delete');

        // RoadMap
        Route::get('/my-project/{id}/roadmap', 'RoadmapController@index')->name('project-roadmap');
        Route::get('/my-project/roadmap/tasks/{id}', 'RoadmapController@showTask')->name('show-roadmap-task');
        Route::put('/my-project/roadmap/tasks/edit/{id}', 'RoadmapController@editTask')->name('edit-task');

        // Log Activity
        Route::get('/my-project/{id}/log-activity', 'LogActivityController@index')->name('log-activity');


        Route::resource('/my-project', 'ProjectController');
    });

// Admin
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard-admin');
        Route::get('show-project/{id}', 'DashboardController@showProject')
            ->name('show-project-detail');
        Route::get('show-project-user/{id}', 'DashboardController@showProjectUser')
            ->name('show-project-user');
        Route::get('show-task-user/{id}', 'DashboardController@showTaskUser')
            ->name('show-task-user');
        Route::resource('manage-users', 'ManageUsersController');
    });

// lEADER
Route::prefix('leader')
    ->namespace('Leader')
    ->middleware(['auth', 'leader'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard-leader');
    });


Auth::routes();
