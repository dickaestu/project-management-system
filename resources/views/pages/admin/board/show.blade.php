<div class="row task-name mb-3">
    <div class="col-12">
        <h5 class="text-dark float-left">{{ $item->task_name }} </h5>
    </div>
</div>
<div class="row">
    <div class="col-12 col-lg-7 mb-4 mb-lg-0">
        <div class="form-group mb-1">
            <label>Description</label>
            <textarea name="task_description" readonly class="form-control description">{{ $item->task_description }}</textarea>
        </div>
        <div class="form-group mt-3">
            <label>Start Date Task</label>
            <p>{{Carbon\Carbon::create($item->start_date)->format('d - M - Y') }}</p>
        </div>
        <div class="form-group mt-3">
            <label>Due Date Task</label>
            <p>{{Carbon\Carbon::create($item->due_date)->format('d - M - Y') }}</p>
        </div>
        <div class="form-group">
            <label>Sub Task</label>
            <ul  id="list-group-sub-task" class="list-group">
                @forelse ($item->sub_task as $subTask)
                <li class="list-group-item list-sub-task d-flex justify-content-between">
                    @if ($subTask->sub_task_status == false)
                    {{ $subTask->sub_task_name }}
                    <span class="d-block">
                    @else
                
                    <s>{{ $subTask->sub_task_name }}</s>
              
                @endif
                </span> 
             </li>
        @empty 
        <li class="list-group-item list-no-sub-task">No Sub Task</li>
        @endforelse
        
        <div class="hidden-sub-task"></div>
    </ul>
    
</div>

<div class="form-group">
    <label for="">Attachment</label>
    <div class="card shadow-sm" style="max-height: 250px; overflow:auto" >
        <div class="card-body">
            <ul class="list-group">
                @forelse ($item->task_file as $file)
                <li class="list-group-item list-file d-md-flex  justify-content-between align-items-center">
                    {{ $file->file_name }}
                    <span class="d-block">
                        <a href="{{ route('download-file-task-admin', $file->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
                    </span>
                </li>
                @empty 
                <li class="list-group-item list-no-file align-items-center">No File Attached...</li>
                @endforelse
                <div class="hidden-list">
                </div>
            </ul>
        </div>
    </div>
</div>

<div class="form-group">
    <p style="color: #34395e; font-weight:600; font-size:12px">Activity</p>
    @forelse ($item->comment as $comment)
    <div class="assigned-profile float-left mr-2">
        <img
        src="https://ui-avatars.com/api/?name={{ $comment->user->name }}"
        class="rounded-circle border"
        height="40"
        alt=""
        />
    </div>
    <div class="activity float-left">
        <div class="activity-user text-small">
            {{ $comment->user->name }} <small class="ml-2">{{ $comment->created_at->diffForHumans()}}</small>
        </div>
        
        <p class="text-dark mb-1 p-comment">{{ $comment->comment }}</p>
        
    </div>
    <div class="clearfix mb-2"></div>
    @empty
    <p>No comment</p>
    @endforelse
</div>
</div>
<div class="col-12 col-md-5">
  
        <div class="form-group mb-3">
            <label>Board Status Now</label>
            <select  class="form-control form-control-sm boards_id" name="boards_id">
                <option>{{ $item->board->board_name }}</option>
            </select>
        </div>
  
    
    
    <div class="form-group mb-0">
        <p style="color: #34395e; font-weight:600; font-size:12px">Assigned-To</p>
    </div>
    @foreach ($item->task_member as $task)
    <div class="row task-members pl-0 mb-3">
        <div class="col-2 col-md-3 col-lg-2">
            <img
            src="https://ui-avatars.com/api/?name={{ $task->project_members->user->name }}"
            class="rounded-circle avatar-members"
            height="43"
            alt=""
            />
        </div>
        <div class="col-auto col-md-8 col-lg-7">
            <p class="text-dark" style="margin-bottom: -5px;">
                {{ $task->project_members->user->name }}
            </p>
            <small>{{ $task->project_members->role_member }}</small>
        </div>
        
  
</div>
@endforeach


</div>


</div>

