<?php

namespace App\Http\Controllers\Admin;

use App\Board;
use App\BoardTask;
use App\Http\Controllers\Controller;
use App\LogActivity;
use App\Project;
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
            return view('pages.admin.roadmap.index', [
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
            return view('pages.admin.roadmap.index', [
                'item' => $item,
                'listTask' => json_encode($listTask),
                'logs' => $logs
            ]);
        }


        return view('pages.admin.roadmap.index', [
            'item' => $item,
            'listTask' => json_encode($listTask),
            'logs' => $logs
        ]);
    }
}
