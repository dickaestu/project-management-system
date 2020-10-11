<?php

namespace App\Http\Controllers\Admin;

use App\BoardTask;
use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectMember;
use App\TaskMember;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['project', 'project_member'])->where('roles', 'MEMBER')->get();
        $items = Project::with('user')->get();

        // Project
        foreach ($users as $user) {
            $id = $user->id;
            $pm = Project::where('project_manager', $id)->count();
            $project_member = ProjectMember::where('users_id', $id)->whereHas('project', function ($q) {
                return $q->where('deleted_at', null);
            })->count();

            $projects[] = (object)[
                'id' => $id,
                'name' => $user->name,
                'total' => $pm + $project_member
            ];
        }
        // Task
        foreach ($users as $user) {
            $id = $user->id;
            $tasks[] = (object)[
                'id' => $id,
                'name' => $user->name,
                'total' => TaskMember::whereHas("project_members", function ($q) use ($id) {
                    return $q->where("users_id", $id);
                })->whereHas('board_task', function ($q) {
                    return $q->where("deleted_at", null)->whereHas('board', function ($q) {
                        $q->whereHas('project', function ($q) {
                            return $q->where('deleted_at', null);
                        });
                    });
                })->count(),
            ];
        }

        return view('pages.admin.dashboard', compact('items', 'projects', 'tasks'));
    }

    public function showProject($id)
    {
        $items = BoardTask::with('task_member.project_members.user')->whereHas('board', function ($q) use ($id) {
            return $q->where('projects_id', $id);
        })->get();

        $members = ProjectMember::with('user')->where('projects_id', $id)->get();

        return view('pages.admin.show-project', compact('items', 'members'));
    }


    public function showProjectUser($id)
    {
        $members = Project::whereHas("project_member", function ($q) use ($id) {
            $q->where("users_id", "=", $id);
        })->get();

        $project_managers = Project::where('project_manager', $id)->get();

        return view('pages.admin.show-project-user', compact('project_managers', 'members'));
    }

    public function showTaskUser($id)
    {
        $items = TaskMember::with('board_task')->whereHas('project_members', function ($q) use ($id) {
            return $q->where("users_id", $id);
        })->whereHas('board_task', function ($q) {
            return $q->where("deleted_at", null)->whereHas('board', function ($q) {
                $q->whereHas('project', function ($q) {
                    return $q->where('deleted_at', null);
                });
            });
        })->get();


        return view('pages.admin.show-task-user', compact('items'));
    }
}
