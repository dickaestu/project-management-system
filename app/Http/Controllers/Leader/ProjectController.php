<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\LogActivity;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $items = Project::with(['user', 'project_member.user', 'projectFile'])->get();
        return view('pages.leader.project.index', compact('items'));
    }

    public function showMember($id)
    {
        $item = Project::with(['project_member.user', 'user'])->findOrFail($id);

        return view('pages.leader.project.show-member', compact('item'));
    }

    public function edit($id)
    {
        $item = Project::findOrFail($id);

        return view('pages.leader.project.edit', compact('item'));
    }

    public function update(ProjectRequest $request, $id)
    {
        $data = $request->all();
        if ($request->project_logo != null) {
            $data['project_logo'] = $request->file('project_logo')->store(
                'assets/project_logo',
                'public'
            );
        }
        $item = Project::findOrFail($id);

        $item->update($data);

        LogActivity::create([
            'projects_id' => $item->id,
            'activity' => 'Project Leader'  . ' has edited ' . $item->project_name . ' project',
            'activity_icon' => '<i class="fas fa-edit"></i>'
        ]);
        return redirect()->route('project-leader')->with('success', 'Edit Succesfully');
    }
}
