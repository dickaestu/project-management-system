<div class="card">
    <div class="card-header">Project Members</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Roles</th>
                </tr>
                @forelse ($members as $member)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $member->user->name }}</td>
                        <td>{{ $member->role_member }}</td>
                    </tr>
                @empty 
                <tr>
                    <td colspan="3" class="text-center">No Member</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Task</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <tr class="bg-light">
                    <th>#</th>
                    <th>Task Name</th>
                    <th>Board Status</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                    <th>Action</th>
                </tr>
                @forelse ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->task_name }}</td>
                    <td>{{ $item->board->board_name}}</td>
                    <td>{{ Carbon\Carbon::parse($item->start_date)->format('d F,Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($item->due_date)->format('d F,Y') }}</td>
                    <td><button type="button" data-toggle="collapse" data-target="#data{{ $item->id }}" class="btn btn-sm btn-primary accordion-toggle">Assign To</button></td>
                </tr>
                <tr class="accordian-body collapse" id="data{{ $item->id }}" >
                    <td colspan="6">
                        <div class="table-responsive ">
                            <table class="table table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                                @forelse ($item->task_member as $member)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    
                                    <td>{{ $member->project_members->user->name }}</td>
                                </tr>
                                @empty 
                                <tr>
                                    <td colspan="2" class="text-center">Data is empty</td>
                                </tr>
                                @endforelse
                            </table>
                        </div>
                    </td>
                </tr>
                @empty 
                <tr>
                    <td colspan="6" class="text-center">Data is empty</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>