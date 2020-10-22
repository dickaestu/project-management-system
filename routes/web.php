<?php

use App\User;
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
        Route::get('/my-project/archived-project', 'ProjectController@archivedProject')->name('archived-project');
        Route::get('/my-project/restore-project/{id}', 'ProjectController@restoreProject')->name('restore-project');

        // Board
        Route::get('/my-project/{id}/board', 'BoardController@index')->name('project-board');
        Route::put('/my-project/board/{id}/edit', 'BoardController@editBoard')->name('edit-board');
        Route::post('/my-project/{id}/board/create', 'BoardController@create')->name('create-board');
        Route::delete('/my-project/{id}/board/delete', 'BoardController@deleteBoard')->name('delete-board');

        // Task
        Route::get('/my-project/{id}/board/task', 'BoardController@showTask')->name('show-task');
        Route::get('/my-project/{id}/board/show-create-task', 'BoardController@showCreateTask')->name('show-create-task');
        Route::post('/my-project/{id}/board/create-task', 'BoardController@createTask')->name('create-task');
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
        Route::get('/my-project/archived-task/{id}', 'BoardController@archivedTask')->name('archived-task');
        Route::get('/my-project/restore-task/{id}', 'BoardController@restoreTask')->name('restore-task');

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

        // Notifications Project Member
        Route::post('/assigned-projects/get', 'NotificationController@get');
        Route::get('/assigned-projects/mark-all-read/{user}', function (User $user) {
            $user->unreadNotifications->markAsRead();
            return response(['message' => 'done']);
        });

        Route::resource('/my-project', 'ProjectController');
    });

// Admin
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard-admin');
        Route::get('show-project-member/{id}', 'DashboardController@showProjectMember')
            ->name('show-project-member');
        Route::get('show-project-user/{id}', 'DashboardController@showProjectUser')
            ->name('show-project-user');
        Route::get('show-task-user/{id}', 'DashboardController@showTaskUser')
            ->name('show-task-user');
        Route::resource('manage-users', 'ManageUsersController');

        // Project File
        Route::get('/project-file/{id}', 'ProjectFileController@index')
            ->name('project-file-admin');
        Route::get('/project-file/download/{id}', 'ProjectFileController@download')->name('project-file-download-admin');

        // Roadmap
        Route::get('/roadmap/{id}', 'RoadmapController@index')->name('project-roadmap-admin');

        // Board
        Route::get('/board/{id}', 'BoardController@index')->name('project-board-admin');
        Route::get('/board/task/{id}', 'BoardController@showTask')->name('show-task-admin');
        Route::get('/download-task-file/{id}', 'BoardController@downloadFileTask')->name('download-file-task-admin');

        // Log Activity
        Route::get('/log-activity/{id}', 'LogActivityController@index')->name('log-activity-admin');
    });

// lEADER
Route::prefix('leader')
    ->namespace('Leader')
    ->middleware(['auth', 'leader'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard-leader');
        Route::get('/projects', 'ProjectController@index')
            ->name('project-leader');
        Route::get('/projects/edit/{id}', 'ProjectController@edit')
            ->name('project-leader-edit');
        Route::put('/projects/update/{id}', 'ProjectController@update')
            ->name('project-leader-update');
        Route::get('/show-member/{id}', 'ProjectController@showMember')
            ->name('show-member-leader');

        // Search
        Route::post('/search-project', 'ProjectController@search')
            ->name('search-project-leader');

        // Overview
        Route::get('/projects/overview/{id}', 'ProjectOverview@index')
            ->name('overview-leader');

        // Project File
        Route::get('/project-file/{id}', 'ProjectFileController@index')
            ->name('project-file-leader');
        Route::post('/project-file/{id}/upload-project-file', 'ProjectFileController@store')
            ->name('project-file-leader-upload');
        Route::get('/project-file/download/{id}', 'ProjectFileController@download')->name('project-file-leader-download');
        Route::delete('/project-file/delete/{id}', 'ProjectFileController@destroy')->name('project-file-leader-delete');

        // Roadmap
        Route::get('/roadmap/{id}', 'RoadmapController@index')->name('project-roadmap-leader');
        Route::get('/roadmap/tasks/{id}', 'RoadmapController@showTask')->name('show-roadmap-task-leader');
        Route::put('/roadmap/tasks/edit/{id}', 'RoadmapController@editTask')->name('edit-task-leader');

        // Board
        Route::get('/board/{id}', 'BoardController@index')->name('project-board-leader');
        Route::post('/board/{id}/create', 'BoardController@create')->name('create-board-leader');
        Route::put('/board/{id}/edit', 'BoardController@editBoard')->name('edit-board-leader');
        Route::delete('/board/{id}/delete', 'BoardController@deleteBoard')->name('delete-board-leader');
        Route::delete('/delete-task/{id}', 'BoardController@deleteTask')->name('delete-task-leader');
        Route::delete('/archive-task/{id}', 'BoardController@archiveTask')->name('archive-task-leader');
        Route::get('/board/{id}/show-create-task', 'BoardController@showCreateTask')->name('show-create-task-leader');
        Route::post('/board/{id}/create-task', 'BoardController@createTask')->name('create-task-leader');
        Route::get('/board/task/{id}', 'BoardController@showTask')->name('show-task-leader');
        Route::put('/task/{id}name', 'BoardController@taskNameEdit')->name('edit-task-name-leader');
        Route::post('/upload-task-file/{id}', 'BoardController@uploadFileTask')->name('upload-file-task-leader');
        Route::get('/download-task-file/{id}', 'BoardController@downloadFileTask')->name('download-file-task-leader');
        Route::delete('/delete-task-file/{id}', 'BoardController@deleteFileTask')->name('delete-file-task-leader');
        Route::post('/sub-task/{id}', 'BoardController@storeSubTask')->name('add-sub-task-leader');
        Route::get('/status-sub-task/{id}', 'BoardController@changeStatusSubTask')->name('change-status-sub-task-leader');
        Route::delete('/delete-sub-task/{id}', 'BoardController@deleteSubTask')->name('delete-sub-task-leader');
        Route::put('/change-tags/{id}', 'BoardController@changeTags')->name('change-tags-leader');
        Route::post('/add-coment/{id}', 'BoardController@addComment')->name('add-comment-leader');
        Route::delete('/comment/delete/{id}', 'BoardController@deleteComment')->name('delete-comment-leader');
        Route::put('/change-status-task/{id}', 'BoardController@changeStatus')->name('change-status-leader');
        Route::get('/task-member/{id}', 'BoardController@getMember')->name('cari-member-leader');
        Route::post('/create-task-member', 'BoardController@createTaskMember')->name('create-task-member-leader');
        Route::delete('/delete-task-member/{id}', 'BoardController@deleteTaskMember')->name('delete-task-member-leader');
        Route::put('/task/description/{id}', 'BoardController@taskDescriptionUpdate')->name('task-description-update-leader');

        // Log Activity
        Route::get('/log-activity/{id}', 'LogActivityController@index')->name('log-activity-leader');
    });




Auth::routes();
