<?php

namespace App\Http\Controllers\Leader;

use App\Board;
use App\BoardTask;
use App\Http\Controllers\Controller;
use App\LogActivity;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectOverview extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = Project::findOrFail($id);
        $board_tasks = BoardTask::with(['board'])->whereHas('board', function ($q) use ($id) {
            return $q->where('projects_id', $id);
        })->orderBy('due_date', 'asc')->get();
        $h_3 = Carbon::now()->addDays(2)->format('Y-m-d');
        $deadline_day = Carbon::now()->format('Y-m-d');

        // Roadmap

        $boards = Board::where('projects_id', $id)->get();
        $logs = LogActivity::where('projects_id', $id)->orderBy('created_at', 'DESC')->get()->take(10);

        foreach ($boards as $board) {
            $tasks[] = BoardTask::where('boards_id', $board->id)->get();
        }

        if (empty($tasks)) {
            $listTask = 'Empty';
            return view('pages.leader.overview.index', [
                'item' => $item,
                'listTask' => json_encode($listTask),
                'logs' => $logs,
                'h_3' => $h_3,
                'deadline_day' => $deadline_day,
                'tasks' => $board_tasks
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
            return view('pages.leader.overview.index', [
                'item' => $item,
                'listTask' => json_encode($listTask),
                'logs' => $logs,
                'h_3' => $h_3,
                'deadline_day' => $deadline_day,
                'tasks' => $board_tasks
            ]);
        }

        return view('pages.leader.overview.index', [
            'item' => $item,
            'listTask' => json_encode($listTask),
            'logs' => $logs,
            'h_3' => $h_3,
            'deadline_day' => $deadline_day,
            'tasks' => $board_tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
