<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardTask;
use App\Project;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index($id)
    {
        $item = Project::findOrFail($id);
        $boards = Board::with(['board_task'])->where('projects_id', $id)->get();
        return view('pages.board.index', compact('item', 'boards'));
    }

    public function create(Request $request, $id)
    {
        Board::create([
            'projects_id' => $id,
            'board_name' => $request->board_name
        ]);

        return redirect()->route('project-board', $id)->with('success', 'Success Create' . $request->board_name);
    }

    public function showTask($id)
    {
        $item = BoardTask::findOrFail($id);
        return view('pages.board.show', compact('item'));
    }


    public function showCreateTask($id)
    {
        $id = $id;
        return view('pages.board.create-task', compact('id'));
    }

    public function createTask(Request $request, $id)
    {
        $data = $request->all();
        $item = BoardTask::create($data);
        return response()->json($item);
    }

    public function taskDescriptionUpdate(Request $request, $id)
    {
        $data = $request->all();
        $item = BoardTask::findOrFail($id);

        $item->update($data);
        return response()->json();
    }
}
