<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use App\Project;
use App\ProjectFile;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\ProjectMember;
use App\User;

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

        $data = $request->all();
        if ($request->project_logo != null) {
            $data['project_logo'] = $request->file('project_logo')->store(
                'assets/project_logo',
                'public'
            );
        }
        $data['project_manager'] = Auth::id();

        $project_id = Project::create($data);

        if ($request->hasFile('file_name')) {
            foreach ($request->file('file_name') as $file_name) {
                $file[] = [
                    'projects_id' => $project_id->id,
                    'file_name' => $file_name->store(
                        'assets/file_project',
                        'public'
                    ),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            ProjectFile::insert($file);
        }

        return redirect()->route('my-project.index');
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
    public function update(Request $request, $id)
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
        return redirect()->route('my-project.index')->with('success', 'Edit Succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function deleteMember($id)
    {
        $item = ProjectMember::findOrFail($id);
        $item->delete();

        return response()->json([
            'success' => 'Data berhasil dihapus',
        ]);
    }

    public function getUser(Request $request)
    {

        if ($request->has('q')) {
            $cari = $request->q;
            $users = User::select('id', 'name')->where('name', 'LIKE', "%$cari%")->get();
            return response()->json($users);
        }
    }

    public function createMember(Request $request)
    {
        $data = $request->all();
        $item = ProjectMember::create($data);


        return response()->json([
            'id' => $item->id,
            'name' => $item->user->name,
            'role_member' => $item->role_member
        ]);
    }
}
