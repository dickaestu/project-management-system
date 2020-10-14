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
