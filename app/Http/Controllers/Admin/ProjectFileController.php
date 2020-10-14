<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    public function index($id)
    {
        $project = Project::findOrFail($id);
        $items = ProjectFile::where('projects_id', $id)->get();

        return view('pages.admin.project-file.index', compact('items', 'project'));
    }

    public function download($id)
    {
        $item = ProjectFile::findOrFail($id);
        $file_path = Storage::url($item->file_path);
        return response()->download(public_path($file_path));
    }
}
