<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardTask;
use App\Project;
use App\ProjectMember;
use App\TaskFile;
use App\TaskMember;
use App\User;
use Carbon\Carbon;
use Faker\Provider\Barcode;
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
        $boards = Board::where('id', '!=', $item->boards_id)->where('projects_id', $item->board->projects_id)->get();
        return view('pages.board.show', compact('item', 'boards'));
    }


    public function showCreateTask($id)
    {
        $id = $id;
        return view('pages.board.create-task', compact('id'));
    }

    public function createTask(Request $request, $id)
    {
        $project = Board::findOrFail($request->boards_id);
        // $start = $project->project->start;
        // $end = $project->project->end;
        $data = $request->all();

        $item = BoardTask::create($data);
        return response()->json($item);
    }

    public function deleteTask($id)
    {
        $item = BoardTask::findOrFail($id);
        $item->delete();
        return response()->json([
            'success' => 'Delete Successfully',
        ]);
    }

    public function taskDescriptionUpdate(Request $request, $id)
    {
        $data = $request->all();
        $item = BoardTask::findOrFail($id);

        $item->update($data);
        return response()->json(['data' => $item->task_description]);
    }

    public function getMember(Request $request, $id)
    {
        $cari = $request->q;
        if ($request->has('q')) {

            $members = User::select('id', 'name')->where('name', 'LIKE', "%$cari%")
                ->whereHas("project_member", function ($q) use ($id) {
                    $q->where("projects_id", "=", $id);
                })
                ->get();


            return response()->json($members);
        }
    }

    public function createTaskMember(Request $request)
    {


        $project_member = ProjectMember::where('users_id', $request->users_id)
            ->where('projects_id', $request->projects_id)->first();

        if (TaskMember::where('board_tasks_id', $request->board_tasks_id)
            ->where('project_members_id', $project_member->id)->first() == !null
        ) {
            return response()->json([
                'failed' => 'error'
            ]);
        }
        $item = TaskMember::create([
            'board_tasks_id' => $request->board_tasks_id,
            'project_members_id' => $project_member->id,
        ]);


        return response()->json([
            'id' => $item->id,
            'name' => $item->project_members->user->name,
            'role_member' => $item->project_members->role_member
        ]);
    }

    public function deleteTaskMember($id)
    {
        $item = TaskMember::findOrFail($id);
        $item->delete();

        return response()->json([
            'success' => 'Delete Successfully',
        ]);
    }

    public function changeStatus(Request $request, $id)
    {
        $item = BoardTask::findOrFail($id);
        $data = $request->boards_id;
        $item->update([
            'boards_id' => $data,
        ]);

        return redirect()->route('project-board', $item->board->projects_id);
    }

    public function statusTask(Request $request, $id)
    {

        $item = BoardTask::findOrFail($id);

        if ($request->status == 'true') {
            $item->status_task = true;
            $item->save();
        } else {
            $item->status_task = false;
            $item->save();
        }


        return redirect()->route('project-board', $item->board->projects_id);
    }

    public function uploadFileTask(Request $request, $id)
    {
        if ($request->hasFile('file_name')) {
            $originalName = $request->file('file_name')->getClientOriginalName();

            TaskFile::create([
                'board_tasks_id' => $id,
                'file_name' => $originalName,
                'file_path' => $request->file('file_name')->storeAs('public/assets/file_task', $originalName),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        return response()->json();
    }
}
