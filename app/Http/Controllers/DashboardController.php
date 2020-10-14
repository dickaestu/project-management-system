<?php

namespace App\Http\Controllers;

use App\BoardTask;
use App\Project;
use App\ProjectMember;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $id = Auth::id();

        // Hitung Pending Project
        $pending_project_as_pm = Project::where('project_manager', $id)
            ->where('project_status', 'Pending')->count();

        $pending_project_as_member = Project::where('project_status', 'Pending')
            ->whereHas('project_member', function ($q) use ($id) {
                $q->where('users_id', $id);
            })->count();
        $pending_project = $pending_project_as_pm + $pending_project_as_member;

        // Hitung Project On Progress
        $progress_project_as_pm = Project::where('project_manager', $id)
            ->where('project_status', 'In Progress')->count();

        $progress_project_as_member = Project::where('project_status', 'In Progress')
            ->whereHas('project_member', function ($q) use ($id) {
                $q->where('users_id', $id);
            })->count();
        $progress_project = $progress_project_as_pm + $progress_project_as_member;

        // Hitung Total Project
        $total_project_as_pm = Project::where('project_manager', $id)->count();

        $total_project_as_member = Project::whereHas('project_member', function ($q) use ($id) {
            $q->where('users_id', $id);
        })->count();
        $total_project = $total_project_as_pm + $total_project_as_member;

        // Hitung Project On Progress
        $completed_project_as_pm = Project::where('project_manager', $id)
            ->where('project_status', 'Completed')->count();

        $completed_project_as_member = Project::where('project_status', 'Completed')
            ->whereHas('project_member', function ($q) use ($id) {
                $q->where('users_id', $id);
            })->count();
        $completed_project = $completed_project_as_pm + $completed_project_as_member;

        // Due Tasks
        $deadline_start_date = Carbon::now()->format('Y-m-d');
        $deadline_due_date = Carbon::now()->addDays(2)->format('Y-m-d');

        $due_tasks = BoardTask::with(['board.project'])
            ->whereBetween('due_date', [$deadline_start_date, $deadline_due_date])
            ->whereHas('board', function ($q) {
                $q->whereHas('project', function ($query) {
                    $query->where('project_status', 'In Progress');
                });
            })->whereHas('task_member', function ($q) use ($id) {
                $q->whereHas('project_members', function ($query) use ($id) {
                    $query->where('users_id', $id);
                });
            })->orderBy('due_date', 'asc')->get();


        // In Going Task
        $in_going_tasks = BoardTask::with(['board.project'])->whereHas('board', function ($q) {
            $q->whereHas('project', function ($query) {
                $query->where('project_status', 'In Progress');
            });
        })->whereHas('task_member', function ($q) use ($id) {
            $q->whereHas('project_members', function ($query) use ($id) {
                $query->where('users_id', $id);
            });
        })->orderBy('created_at', 'desc')->get();


        return view('pages.dashboard', compact(
            'pending_project',
            'progress_project',
            'total_project',
            'completed_project',
            'due_tasks',
            'in_going_tasks'
        ));
    }
}
