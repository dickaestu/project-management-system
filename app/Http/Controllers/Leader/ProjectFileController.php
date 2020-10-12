<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\LogActivity;
use App\Project;
use App\ProjectFile;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::findOrFail($id);
        $items = ProjectFile::where('projects_id', $id)->get();



        return view('pages.leader.project.project-file', compact('items', 'project'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate(
            ['file_name' => 'required'],
            ['file_name.required' => 'Upload Failed ']
        );

        $count = count($request->file_name);
        $item = Project::findOrFail($id);
        if ($request->hasFile('file_name')) {
            foreach ($request->file('file_name') as $file_name) {
                $originalName = $file_name->getClientOriginalName();
                $file[] = [
                    'projects_id' => $id,
                    'file_name' => $originalName,
                    'file_path' => $file_name->store('assets/file_project', 'public'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            ProjectFile::insert($file);
        }

        LogActivity::create([
            'projects_id' => $id,
            'activity' => "Project Leader" . ' has added ' . $count . ' new file in ' . $item->project_name,
            'activity_icon' => '<i class="fas fa-file-upload"></i>'
        ]);

        return redirect()->route('project-file-leader', $id);
    }

    public function download($id)
    {
        $item = ProjectFile::findOrFail($id);
        $file_path = Storage::url($item->file_path);
        return response()->download(public_path($file_path));
    }

    public function destroy($id)
    {
        $item = ProjectFile::findOrFail($id);
        $projects_id = $item->projects_id;
        $path = '/public/' . $item->file_path;
        Storage::delete($path);
        $item->delete();

        LogActivity::create([
            'projects_id' => $item->projects_id,
            'activity' => "Project Leader" . ' has deleted ' . $item->file_name . ' in ' . $item->project->project_name,
            'activity_icon' => '<i class="fas fa-trash"></i>'
        ]);

        return redirect()->route('project-file-leader', $projects_id);
    }
}
