<?php

namespace App\Http\Controllers;

use App\LogActivity;
use App\Project;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $item = Project::findOrFail($id);
        $logs = LogActivity::where('projects_id', $id)->orderBy('created_at', 'DESC')->get();

        return view('pages.log-activity', compact('logs', 'item'));
    }
}
