<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
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
}
