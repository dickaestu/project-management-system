<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardTask;
use App\ProjectFile;
use App\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;

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



        return view('pages.project.project-file', compact('items', 'project'));
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

        return redirect()->route('project-file', $id);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProjectFile::findOrFail($id);
        $projects_id = $item->projects_id;
        $path = '/public/' . $item->file_path;
        Storage::delete($path);
        $item->delete();

        return redirect()->route('project-file', $projects_id);
    }

    public function download($id)
    {
        $item = ProjectFile::findOrFail($id);
        $file_path = Storage::url($item->file_path);
        return response()->download(public_path($file_path));
    }
}
