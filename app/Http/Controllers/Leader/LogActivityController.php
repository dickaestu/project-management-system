<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\LogActivity;
use App\Project;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function index($id)
    {
        $item = Project::findOrFail($id);
        $logs = LogActivity::where('projects_id', $id)->orderBy('created_at', 'DESC')->get();

        return view('pages.leader.log-activity', compact('logs', 'item'));
    }
}
