<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardTask;
use App\CommentTask;
use App\LogActivity;
use App\Project;
use App\ProjectMember;
use App\SubTask;
use App\TaskFile;
use App\TaskMember;
use App\User;
use Carbon\Carbon;
use Auth;
use Faker\Provider\Barcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{
    public function index($id)
    {
        $item = Project::findOrFail($id);
        $boards = Board::with(['board_task'])->where('projects_id', $id)->get();

        $logs = LogActivity::where('projects_id', $id)->orderBy('created_at', 'DESC')->get()->take(10);
        return view('pages.board.index', compact('item', 'boards', 'logs'));
    }

    public function create(Request $request, $id)
    {
        Board::create([
            'projects_id' => $id,
            'board_name' => $request->board_name
        ]);

        LogActivity::create([
            'projects_id' => $id,
            'activity' => Auth::user()->name . ' has created '  . $request->board_name . ' board',
            'activity_icon' => '<i class="fas fa-square"></i>'
        ]);

        return redirect()->route('project-board', $id)->with('success', 'Success Create' . $request->board_name);
    }

    public function editBoard(Request $request, $id)
    {
        $item = Board::findOrFail($id);

        LogActivity::create([
            'projects_id' => $item->projects_id,
            'activity' => Auth::user()->name . ' has renamed '  . $item->board_name . ' board into ' . $request->board_name . ' board',
            'activity_icon' => '<i class="fas fa-pencil-alt"></i>'
        ]);

        $item->update(['board_name' => $request->board_name]);



        return redirect()->back();
    }

    public function deleteBoard($id)
    {
        $item = Board::findOrFail($id);
        $item->board_task()->delete();
        $item->delete();
        LogActivity::create([
            'projects_id' => $item->projects_id,
            'activity' => Auth::user()->name . ' has deleted '  . '"' . $item->board_name . '"' . ' board',
            'activity_icon' => '<i class="fas fa-trash-alt"></i>'
        ]);
        return response()->json([
            'success' => 'Delete Successfully',
        ]);
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
        $data = $request->all();

        $item = BoardTask::create($data);
        LogActivity::create([
            'projects_id' => $item->board->projects_id,
            'activity' => Auth::user()->name . ' has created '  . '"' . $item->task_name . '"' . ' task',
            'activity_icon' => '<i class="fas fa-tasks"></i>'
        ]);
        return response()->json($item);
    }

    public function archiveTask($id)
    {
        $item = BoardTask::findOrFail($id);
        $item->delete();
        LogActivity::create([
            'projects_id' => $item->board->projects_id,
            'activity' => Auth::user()->name . ' archived '  . '"' . $item->task_name . '"' . ' task',
            'activity_icon' => '<i class="fas fa-archive"></i>'
        ]);
        return response()->json([
            'success' => 'Task has been archived',
        ]);
    }

    public function deleteTask($id)
    {
        $item = BoardTask::findOrFail($id);
        foreach ($item->task_member as $task_member) {
            $task_member->delete();
        }
        foreach ($item->task_file as $task_file) {
            $task_file->delete();
        }
        foreach ($item->sub_task as $sub_task) {
            $sub_task->delete();
        }
        foreach ($item->comment as $comment) {
            $comment->delete();
        }
        $item->forceDelete();
        LogActivity::create([
            'projects_id' => $item->board->projects_id,
            'activity' => Auth::user()->name . ' has deleted '  . '"' . $item->task_name . '"' . ' task',
            'activity_icon' => '<i class="fas fa-trash"></i>'
        ]);
        return response()->json([
            'success' => 'Delete Successfully',
        ]);
    }

    public function taskNameEdit(Request $request, $id)
    {
        $data = $request->all();
        $item = BoardTask::findOrFail($id);
        LogActivity::create([
            'projects_id' => $item->board->projects_id,
            'activity' => Auth::user()->name . ' has renamed task '  . '"' . $item->task_name . '"' . ' into ' . '"' . $request->task_name . '"' . ' task',
            'activity_icon' => '<i class="fas fa-pen"></i>'
        ]);
        $item->update($data);
        return response()->json(['data' => $item->task_name]);
    }

    public function taskDescriptionUpdate(Request $request, $id)
    {
        $data = $request->all();
        $item = BoardTask::findOrFail($id);

        $item->update($data);
        LogActivity::create([
            'projects_id' => $item->board->projects_id,
            'activity' => Auth::user()->name . ' has updated the description of '  . $item->task_name . ' task',
            'activity_icon' => '<i class="fas fa-pencil-alt"></i>'
        ]);
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

        LogActivity::create([
            'projects_id' => $item->board_task->board->projects_id,
            'activity' => Auth::user()->name . ' assigned '  . $item->project_members->user->name . ' into ' . $item->board_task->task_name . ' task',
            'activity_icon' => '<i class="fas fa-user-plus"></i>'
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

        LogActivity::create([
            'projects_id' => $item->board_task->board->projects_id,
            'activity' => Auth::user()->name . ' has removed '  . $item->project_members->user->name . ' in ' . $item->board_task->task_name . ' task',
            'activity_icon' => '<i class="fas fa-user-minus"></i>'
        ]);
        return response()->json([
            'success' => 'Delete Successfully',
        ]);
    }

    public function changeStatus(Request $request, $id)
    {
        $item = BoardTask::findOrFail($id);
        $task = BoardTask::findOrFail($id);

        $data = $request->boards_id;
        $item->update([
            'boards_id' => $data,
        ]);
        LogActivity::create([
            'projects_id' => $item->board->projects_id,
            'activity' => Auth::user()->name . ' has changed '  . $item->task_name . ' task from ' . $task->board->board_name . ' board into ' . $item->board->board_name . ' board',
            'activity_icon' => '<i class="fas fa-exchange-alt"></i>'
        ]);
        return redirect()->route('project-board', $item->board->projects_id);
    }

    public function changeTags(Request $request, $id)
    {
        $item = BoardTask::findOrFail($id);
        LogActivity::create([
            'projects_id' => $item->board->projects_id,
            'activity' => Auth::user()->name . ' has changed tags '   . '"' . $item->tags . '"' . ' to ' . '"' . $request->tags . '"' . ' in ' . '"' . $item->task_name . '"' . ' task',
            'activity_icon' => '<i class="fas fa-pencil-alt"></i>'
        ]);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('project-board', $item->board->projects_id);
    }



    public function uploadFileTask(Request $request, $id)
    {
        $request->validate(
            ['file_name' => 'required'],
            ['file_name.required' => 'Upload Failed ']
        );

        if ($request->hasFile('file_name')) {
            $originalName = $request->file('file_name')->getClientOriginalName();

            $item = TaskFile::create([
                'board_tasks_id' => $id,
                'file_name' => $originalName,
                'file_path' => $request->file('file_name')->store('assets/file_task', 'public'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        LogActivity::create([
            'projects_id' => $item->board_task->board->projects_id,
            'activity' => Auth::user()->name . ' has uploaded new file named '  . '"' . $item->file_name . '"' . ' in ' . '"' . $item->board_task->task_name . '"' . ' task',
            'activity_icon' => '<i class="fas fa-file-upload"></i>'
        ]);

        return response()->json([
            'id' => $item->id,
            'name' => $originalName
        ]);
    }

    public function downloadFileTask($id)
    {
        $item = TaskFile::findOrFail($id);
        $file_path = Storage::url($item->file_path);
        return response()->download(public_path($file_path));
    }

    public function deleteFileTask($id)
    {
        $item = TaskFile::findOrFail($id);
        $path = '/public/' . $item->file_path;
        Storage::delete($path);
        $item->delete();
        LogActivity::create([
            'projects_id' => $item->board_task->board->projects_id,
            'activity' => Auth::user()->name . ' has deleted '   . $item->file_name .  ' in ' . '"' . $item->board_task->task_name . '"' . ' task',
            'activity_icon' => '<i class="fas fa-trash"></i>'
        ]);
        return response()->json([
            'success' => 'Delete Successfully',
        ]);
    }

    public function storeSubTask(Request $request, $id)
    {
        $request->validate(
            ['sub_task_name' => 'required'],
            ['sub_task_name.required' => 'Failed To Add Sub Task']
        );

        $data = $request->all();
        $data['board_tasks_id'] = $id;
        $item = SubTask::create($data);
        LogActivity::create([
            'projects_id' => $item->board_task->board->projects_id,
            'activity' => Auth::user()->name . ' has created sub task '   . '"' . $item->sub_task_name . '"' . ' in ' . '"' . $item->board_task->task_name . '"' . ' task',
            'activity_icon' => '<i class="fas fa-plus"></i>'
        ]);
        return response()->json($item);
    }

    public function changeStatusSubTask(Request $request, $id)
    {
        if ($request->status == 'true') {
            $item = SubTask::findOrFail($id);

            $item->update([
                'sub_task_status' => true
            ]);
            LogActivity::create([
                'projects_id' => $item->board_task->board->projects_id,
                'activity' => Auth::user()->name . ' has changed '   . '"' . $item->sub_task_name . '"' . ' sub task status from not completed into completed',
                'activity_icon' => '<i class="fas fa-check"></i>'
            ]);

            return response()->json($item);
        } else {
            $item = SubTask::findOrFail($id);
            $item->update([
                'sub_task_status' => false
            ]);
            LogActivity::create([
                'projects_id' => $item->board_task->board->projects_id,
                'activity' => Auth::user()->name . ' has changed '   . '"' . $item->sub_task_name . '"' . ' sub task status from completed into not completed',
                'activity_icon' => '<i class="fas fa-times"></i>'
            ]);

            return response()->json($item);
        }
    }

    public function deleteSubTask($id)
    {
        $item = SubTask::findOrFail($id);
        $item->delete();

        LogActivity::create([
            'projects_id' => $item->board_task->board->projects_id,
            'activity' => Auth::user()->name . ' has deleted sub task '   . '"' . $item->sub_task_name . '"' . ' in ' . '"' . $item->board_task->task_name . '"' . ' task',
            'activity_icon' => '<i class="fas fa-trash"></i>'
        ]);
        return response()->json([
            'success' => 'Delete Successfully',
        ]);
    }

    public function addComment(Request $request, $id)
    {
        $request->validate(
            ['comment' => 'required|max:255'],
            [
                'comment.required' => 'Please enter your comment',
                'comment.max' => 'Max character 255'
            ]
        );

        $data = $request->all();
        $data['board_tasks_id'] = $id;
        $data['users_id'] = Auth::id();
        $item = CommentTask::create($data);
        LogActivity::create([
            'projects_id' => $item->board_task->board->projects_id,
            'activity' => Auth::user()->name . ' has commented on '  . $item->board_task->task_name . ' task',
            'activity_icon' => '<i class="fas fa-comment"></i>'
        ]);
        return response()->json($item);
    }

    public function deleteComment($id)
    {
        $item = CommentTask::findOrFail($id);
        $item->delete();

        return response()->json([
            'success' => 'Delete Successfully',
        ]);
    }
}
