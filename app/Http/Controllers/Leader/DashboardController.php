<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project_on_progress = Project::where('project_status', 'In Progress')->count();
        $project_completed = Project::where('project_status', 'Completed')->count();
        $project_pending = Project::where('project_status', 'Pending')->count();
        $project_abandoned = Project::where('project_status', 'Abandoned')->count();

        // Deadline Project
        $deadline_start = Carbon::now()->format('Y-m-d');
        $deadline_end = Carbon::now()->addDays(7)->format('Y-m-d');

        $deadline_project = Project::with('user')->whereBetween('end', [$deadline_start, $deadline_end])
            ->where('project_status', 'In Progress')
            ->orderBy('end', 'asc')->get();

        $projects = Project::with('user')->where('project_status', 'In Progress')->get();

        return view('pages.leader.dashboard', compact(
            'project_on_progress',
            'project_completed',
            'project_pending',
            'project_abandoned',
            'deadline_project',
            'projects'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
