<?php

namespace App\Http\Controllers\Leader;

use App\Board;
use App\BoardTask;
use App\Http\Controllers\Controller;
use App\LogActivity;
use Auth;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function index($id)
    {
        $item = Project::findOrFail($id);

        $boards = Board::where('projects_id', $id)->get();
        $logs = LogActivity::where('projects_id', $id)->orderBy('created_at', 'DESC')->get()->take(10);

        foreach ($boards as $board) {
            $tasks[] = BoardTask::where('boards_id', $board->id)->get();
        }

        if (empty($tasks)) {
            $listTask = 'Empty';
            return view('pages.leader.roadmap.index', [
                'item' => $item,
                'listTask' => json_encode($listTask),
                'logs' => $logs
            ]);
        }

        foreach ($tasks as $task) {
            foreach ($task as $t) {
                $listTask[] = [
                    'id' => $t->id,
                    'task_name' => $t->task_name,
                    'boards_id' => $t->boards_id,
                    'start_date' => $t->start_date,
                    'due_date' => $t->due_date,
                ];
            }
        }
        if (empty($listTask)) {
            $listTask = 'Empty';
            return view('pages.leader.roadmap.index', [
                'item' => $item,
                'listTask' => json_encode($listTask),
                'logs' => $logs
            ]);
        }


        return view('pages.leader.roadmap.index', [
            'item' => $item,
            'listTask' => json_encode($listTask),
            'logs' => $logs
        ]);
    }

    public function showTask($id)
    {
        $item = BoardTask::findOrFail($id);
        $projects_id = $item->board->projects_id;
        $tasks = BoardTask::where('id', '!=', $id)
            ->whereHas("board", function ($q) use ($projects_id) {
                $q->where("projects_id", "=", $projects_id);
            })->get();

        return view('pages.leader.roadmap.show', compact('item', 'tasks'));
    }

    public function editTask(Request $request, $id)
    {
        $item = BoardTask::findOrFail($id);
        $item->update(
            [
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
            ]
        );


        if (!empty($request->add_days && $request->add_tasks)) {
            foreach ($request->add_tasks as $task) {
                $task = BoardTask::findOrFail($task);
                $date = Carbon::parse($task->due_date)->addDays($request->add_days);
                $task->update(['due_date' => $date]);
            }
        }

        LogActivity::create([
            'projects_id' => $item->board->projects_id,
            'activity' => "Project Leader" . ' changed '  . $item->task_name . ' date',
            'activity_icon' => '<i class="fas fa-calendar-alt"></i>'
        ]);

        return redirect()->back()->with('success', 'Update Success');
    }
}
