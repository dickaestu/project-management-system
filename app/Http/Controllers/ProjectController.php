<?php

namespace App\Http\Controllers;

use App\BoardTask;
use App\Http\Requests\ProjectRequest;
use App\LogActivity;
use App\Notifications\ProjectAssigned;
use Illuminate\Http\Request;
use App\Project;
use App\ProjectFile;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\ProjectMember;
use App\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Project::with(['user', 'project_member.user'])
            ->whereHas("project_member", function ($q) {
                $q->where("users_id", "=", Auth::id());
            })
            ->orWhere('project_manager', Auth::id())
            ->get();

        return view('pages.project.my-project', compact('items'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $id = Auth::id();

        $data = $request->all();
        // dd(Carbon::getYearHolidays(2021));
        // dd(Carbon::getBusinessDaysInMonth('2020-11'));
        // dd(Carbon::parse($request->start)->diffInBusinessDays(Carbon::parse($request->end)->endOfDay()));
        // Store logo project ke storage
        if ($request->project_logo != null) {
            $data['project_logo'] = $request->file('project_logo')->store(
                'assets/project_logo',
                'public'
            );
        }
        // set auth id sebagai project manager
        $data['project_manager'] = $id;

        $project_id = Project::create($data);

        if ($request->hasFile('file_name')) {
            foreach ($request->file('file_name') as $file_name) {
                $originalName = $file_name->getClientOriginalName();
                $file[] = [
                    'projects_id' => $project_id->id,
                    'file_name' => $originalName,
                    'file_path' => $file_name->storeAs('public/assets/file_project', $originalName),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            ProjectFile::insert($file);
        }

        LogActivity::create([
            'projects_id' => $project_id->id,
            'activity' => '"' . Auth::user()->name . '"'  . ' has created new project ' . 'named ' . '"' . $request->project_name . '"',
            'activity_icon' => '<i class="fas fa-briefcase"></i>'
        ]);

        return redirect()->route('my-project.index')->with('success', 'Create Project Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Project::with(['project_member.user', 'user'])->findOrFail($id);
        $users = User::pluck('name', 'id')->toArray();

        return view('pages.project.show-member', compact('item', 'users'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Project::findOrFail($id);

        return view('pages.project.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            'activity' => '"' . Auth::user()->name . '"'  . ' has edited ' . $item->project_name . ' project',
            'activity_icon' => '<i class="fas fa-edit"></i>'
        ]);
        return redirect()->route('my-project.index')->with('success', 'Update Succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Project::findOrFail($id);
        // $item->projectFile()->delete();
        // foreach ($item->project_member as $task) {
        //     $task->task_member()->delete();
        // }
        // $item->project_member()->delete();
        $item->delete();
        return redirect()->route('my-project.index')->with('success', 'Project has been archived');
    }

    public function deleteMember($id)
    {
        $item = ProjectMember::findOrFail($id);
        $item->task_member()->delete();
        $item->delete();

        LogActivity::create([
            'projects_id' => $item->projects_id,
            'activity' => '"' . Auth::user()->name . '"'  . ' has removed ' .  '"' . $item->user->name . '"' . ' from ' .   $item->project->project_name,
            'activity_icon' => '<i class="fas fa-user-minus"></i>'
        ]);


        return response()->json([
            'success' => 'Delete Successfully',
        ]);
    }

    public function getUser(Request $request)
    {

        if ($request->has('q')) {
            $cari = $request->q;
            $users = User::select('id', 'name')->where('name', 'LIKE', "%$cari%")
                ->where('roles', 'MEMBER')
                ->get();
            return response()->json($users);
        }
    }

    public function createMember(Request $request)
    {
        $data = $request->all();
        if (
            ProjectMember::where('projects_id', $request->projects_id)->where('users_id', $request->users_id)->first()
            == !null
        ) {
            return response()->json([
                'failed' => 'error'
            ]);
        }
        $item = ProjectMember::create($data);
        LogActivity::create([
            'projects_id' => $item->projects_id,
            'activity' => '"' . Auth::user()->name . '"'  . ' assigned ' .  '"' . $item->user->name . '"' . ' into ' .  '"' . $item->project->project_name . '"' . ' as ' . $item->role_member,
            'activity_icon' => '<i class="fas fa-user-plus"></i>'
        ]);

        $member = User::findOrFail($request->users_id);
        try {
            $member->notify(new ProjectAssigned($item));
        } catch (\Exception $e) {
        }

        return response()->json([
            'id' => $item->id,
            'name' => $item->user->name,
            'role_member' => $item->role_member
        ]);
    }

    public function archivedProject()
    {
        $items = Project::onlyTrashed()->where('project_manager', Auth::id())->get();
        return view('pages.archived-project', compact('items'));
    }

    public function restoreProject($id)
    {
        $item = Project::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('my-project.index')->with('success', 'The project was successfully restored');
    }

    public function showDescription($id)
    {
        $item = Project::findOrFail($id);

        return view('pages.project.show-description', compact('item'));
    }

    public function createUser(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $data = $request->all();

        $data = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json($data);
    }
}
