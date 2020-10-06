<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardTask;
use App\LogActivity;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = Project::findOrFail($id);

        $boards = Board::where('projects_id', $id)->get();
        $logs = LogActivity::where('projects_id', $id)->orderBy('created_at', 'DESC')->get();

        foreach ($boards as $board) {
            $tasks[] = BoardTask::where('boards_id', $board->id)->get();
        }

        if (empty($tasks)) {
            $listTask = 'Empty';
            return view('pages.roadmap.index', [
                'item' => $item,
                'listTask' => json_encode($listTask),
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
            return view('pages.roadmap.index', [
                'item' => $item,
                'listTask' => json_encode($listTask),
            ]);
        }


        return view('pages.roadmap.index', [
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

        return view('pages.roadmap.show', compact('item', 'tasks'));
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

        return redirect()->back()->with('success', 'Update Success');
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
