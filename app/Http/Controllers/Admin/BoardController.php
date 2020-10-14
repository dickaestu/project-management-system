<?php

namespace App\Http\Controllers\Admin;

use App\Board;
use App\BoardTask;
use App\Http\Controllers\Controller;
use App\LogActivity;
use App\Project;
use App\TaskFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{
    public function index($id)
    {
        $item = Project::findOrFail($id);
        $boards = Board::with(['board_task'])->where('projects_id', $id)->get();

        $logs = LogActivity::where('projects_id', $id)->orderBy('created_at', 'DESC')->get()->take(10);
        return view('pages.admin.board.index', compact('item', 'boards', 'logs'));
    }

    public function showTask($id)
    {
        $item = BoardTask::findOrFail($id);
        $boards = Board::where('id', '!=', $item->boards_id)->where('projects_id', $item->board->projects_id)->get();
        return view('pages.admin.board.show', compact('item', 'boards'));
    }

    public function downloadFileTask($id)
    {
        $item = TaskFile::findOrFail($id);
        $file_path = Storage::url($item->file_path);
        return response()->download(public_path($file_path));
    }
}
