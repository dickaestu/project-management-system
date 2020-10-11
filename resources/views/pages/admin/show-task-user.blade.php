 <div class="table-responsive">
    <table class="table table-striped">
        <tr>
            <th>#</th>
            <th>Project Name</th>
            <th>Task Name</th>
            <th>Board Status</th>
        </tr>
        @forelse ($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->board_task->board->project->project_name }}</td>
            <td>{{ $item->board_task->task_name}}</td>
            <td>{{ $item->board_task->board->board_name }}</td>
            </tr>
            @empty 
            <tr>
                <td colspan="4" class="text-center">Data is empty</td>
            </tr>
            @endforelse
        </table>
    </div>