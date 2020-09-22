<div class="row">
    <div class="col-12 col-md-7 mb-4 mb-lg-0">
        <div class="btn-group">
            <a id="attachmentButton" href="#" class="btn btn-icon icon-left btn-secondary text-dark"><i class="fa fa-paperclip" aria-hidden="true"></i> Attachment</a>
            <a href="#" class="btn btn-icon icon-left btn-secondary ml-2 text-dark"><i class="fa fa-plus" aria-hidden="true"></i> Add Sub Task</a>
            @if ($item->status_task == false)
            <a href="{{ route('status-task', $item->id) }}?status=true" class="btn btn-icon icon-left btn-secondary ml-2 mr-3 text-dark"><i class="fa fa-check" aria-hidden="true"></i> Done</a>
            @else
            <a href="{{ route('status-task', $item->id) }}?status=false" class="btn btn-icon icon-left btn-success ml-2 mr-3"><i class="fa fa-check" aria-hidden="true"></i> Done</a>
            @endif
            
        </div>
        <form class="form-upload-file mt-3" enctype="multipart/form-data">
              @csrf
              <div class="form-group mb-2">
                <label for="">Add File</label>
                <input type="file" id="file_name" name="file_name"class="form-control form-control-sm" />
              </div>
              <button type="submit" class="btn btn-primary btn-sm">Upload File</button>
              <button id="cancelButton" type="button" class="btn btn-secondary btn-sm">Cancel</button>
            </form>
        <form class="mt-3 form-update-description">
            @method('PUT')
            @csrf
            <div class="form-group mb-1">
                <label>Description</label>
                <textarea name="task_description" {{ Auth::id() == $item->board->project->project_manager ? "" :"readonly"}} class="form-control description">{{ $item->task_description }}</textarea>
            </div>
            @if (Auth::id() == $item->board->project->project_manager)
            <button class="btn btn-primary btn-sm btn-save-description" style="display: none" type="submit">Save</button>
            <button class="btn btn-light btn-sm mr-3 ml-2 btn-cancel-description" style="display: none" type="reset">
                Cancel
            </button>
            @endif
        </form>
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
            <!-- <div class="progress">
                <div class="progress-bar" role="progressbar" data-width="50%" aria-valuenow="50" aria-valuemin="0"
                aria-valuemax="100">50%</div>
            </div> -->
            
        </div>
      
        <div class="form-group">
            <label for="">Attachment</label>
            <div class="card" style="max-height: 250px; overflow:auto" >
              <div class="card-body">
                <ul class="list-group">
                  @forelse ($item->task_file as $file)
                  <li class="list-group-item list-file d-md-flex  justify-content-between align-items-center">
                    {{ $file->file_name }}
                    <span class="d-block">
                      <a href="{{ route('download-file-task', $file->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
                      <form class="d-inline" action="" method="post">
                        <button type="button" 
                        data-token = "{{ csrf_token() }}"
                        data-url="{{ route('delete-file-task', $file->id) }}"
                        class="btn btn-danger btn-sm button-delete"><i class="fas fa-trash"></i></button>
                      </form>
                    </span>
                  </li>
                  @empty
                   <li class="list-group-item text-center">
                      <h5>File is empty</h5>
                   </li>
                  @endforelse
                  <div class="hidden-list">
                  </div>
                </ul>
              </div>
            </div>
        </div>
        <div class="form-group">
            <p style="color: #34395e; font-weight:600; font-size:12px">Activity</p>
            <div class="assigned-profile float-left mr-2">
                <img
                src="https://ui-avatars.com/api/?name=a"
                class="rounded-circle border"
                height="40"
                alt=""
                />
            </div>
            <div class="activity float-left">
                <div class="activity-user">
                    Cemoren Dallas <span>1 minute ago</span>
                </div>
                <div class="activity-comment">
                    Jangan lupa diklik!
                </div>
                <div class="activity-button">
                    <button class="btn bg-transparent">Edit</button>
                    <button class="btn bg-transparent">Delete</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        {{-- <div class="form-group">
            <div class="assigned-profile mr-2">
                <img
                src="https://ui-avatars.com/api/?name=a"
                class="rounded-circle border"
                height="40"
                alt=""
                />
            </div>
            <textarea name="comment" id="" rows="1" style="border-radius: 5px;"></textarea>
        </div> --}}
    </div>
    <div class="col-12 col-md-5">
        <form action="{{ route('change-status',$item->id) }}" class="mb-3" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group mb-3">
                <label>Change Board Status</label>
                <select class="form-control form-control-sm boards_id" name="boards_id">
                    <option value="0">Status Now ({{ $item->board->board_name }})</option>
                    @foreach ($boards as $board_name)
                    <option value="{{ $board_name->id }}">{{ $board_name->board_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row justify-content-center">
                <button id="change-status" type="submit" class="btn btn-info btn-sm">Change Status</button>
            </div>
        </form>
        
        
        <div class="form-group mb-0">
            <p style="color: #34395e; font-weight:600; font-size:12px">Assigned-To</p>
        </div>
        @foreach ($item->task_member as $task)
        <div class="row task-members pl-0 mb-3">
            <div class="col-2">
                <img
                src="https://ui-avatars.com/api/?name={{ $task->project_members->user->name }}"
                class="rounded-circle avatar-members"
                height="43"
                alt=""
                />
            </div>
            <div class="col-7">
                <p class="text-dark" style="margin-bottom: -5px;">
                    {{ $task->project_members->user->name }}
                </p>
                <small>{{ $task->project_members->role_member }}</small>
            </div>
            <div class="col-2 pt-2">
                <button 
                type="button"
                data-id = "{{ $task->id }}"
                data-token = "{{ csrf_token() }}"
                data-url="{{ route('delete-task-member', $task->id) }}"
                data-name="{{ $task->project_members->user->name }}"
                class="btn button_delete rounded-circle btn-sm py-0 btn-outline-danger"
                >
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    @endforeach
    <div class="hidden-form"></div>
    
    
    <form  class="form-assign" class="mt-4">
        @csrf
        <label>Search</label>
        
        <select name="users_id" id="project_members_id" class="form-control">
            
        </select>
        
        <button type="submit" class="btn btn-success btn-block btn-md mt-3">Add</button>
    </form>
</div>


</div>



<script>
    $('document').ready( function(){
        // Upload File
        $('.form-upload-file').on('submit', function(e){
            e.preventDefault();
            data = new FormData(this)
            $.ajax({
                url: '{{ route('upload-file-task', $item->id) }}',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response){
                  swal('Success', 'Upload Success' , 'success');
                  $('.hidden-list').append(
                      `
                   <li class="list-group-item list-file d-md-flex  justify-content-between align-items-center">
                    `+response.name+`
                    <span class="d-block">
                      <a href="/my-project/download-task-file/`+response.id+`" class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
                      <form class="d-inline" action="" method="post">
                        <button type="button" 
                        data-token = "{{ csrf_token() }}"
                        data-url="/my-project/delete-task-file/`+response.id+`"
                        class="btn btn-danger btn-sm button-delete"><i class="fas fa-trash"></i></button>
                      </form>
                    </span>
                  </li>
                   `
                  )
                },
                error: function(response){
                    swal('Sorry', 'Oops Something Went Wrong', 'error');
                }
            });
        });

        // Untuk Hapus File Task
    $(".list-file").on('click','.button-delete', function (event) {
        let list_file = $(this);
        let token = $(this).data('token');
        let url = $(this).data('url');
        swal({
            title: 'Are you sure?',
            text: name + ' will be removed from task file',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        "_method" : 'DELETE',
                        "_token" : token,
                    },
                    dataType : "JSON",
                    success: function (response){
                        
                        swal(response.success, {
                            icon: 'success',
                        });
                        
                        $(list_file).closest('.list-file').remove()
                    }
                    
                })
                
                
            } 
        });
    });

    // Untuk Hapus File Task yg baru di upload
    $(".hidden-list").on('click','.button-delete', function (event) {
        let list_file = $(this);
        let token = $(this).data('token');
        let url = $(this).data('url');
        swal({
            title: 'Are you sure?',
            text: name + ' will be removed from task file',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        "_method" : 'DELETE',
                        "_token" : token,
                    },
                    dataType : "JSON",
                    success: function (response){
                        
                        swal(response.success, {
                            icon: 'success',
                        });
                        
                        $(list_file).closest('.list-file').remove()
                    }
                    
                })
                
                
            } 
        });
    });

        // Update Description
        $('.form-update-description').on('submit', function(e){
            e.preventDefault();
            var $this = $(this);
            var data = $this.serializeArray();  
            $.ajax({
                url: '{{ route('task-description-update', $item->id) }}',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response){
                    swal('Success', 'Edit Success' , 'success');
                    $('.description').html(response.data)
                    $('.btn-save-description').hide()
                    $('.btn-cancel-description').hide()
                },
                error: function(response){
                    alert('Failed')
                }
            });
        });
        
        // Search member
        $('#project_members_id').select2({
            dropdownParent : $('.bd-example-modal-lg'),
            placeholder : 'Search Name...',
            minimumInputLength: 2,
            ajax: {
                url :'{{ route('cari-member', $item->board->projects_id) }}',
                dataType : 'json',
                delay: 250,
                processResults : function (member){
                    return {
                        results : $.map(member, function(item){
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    }
                },
                cache : true
            }
        });
        
        // Post Member yang sudah di search
        $('.form-assign').on('submit', function(e){
            e.preventDefault();
            var $this = $(this);
            var board_tasks_id = '{{ $item->id }}';
            var projects_id = '{{ $item->board->projects_id }}';
            var data = $this.serializeArray();
            data.splice(1 , 0 ,{name: "board_tasks_id", value: board_tasks_id})   
            data.splice(2 , 0 ,{name: "projects_id", value: projects_id})   
            
            $.ajax({
                url: '{{ route('create-task-member') }}',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response){
                    if(response.failed == 'error'){
                        swal('Sorry', 'Member already exists', 'error');
                    } else {
                        swal('Success', response.name + ' Successfully Added' , 'success');
                        $('.hidden-form').append(
                        `
                        <div class="row task-members pl-0 mb-3">
                            <div class="col-2">
                                <img
                                src="https://ui-avatars.com/api/?name=`+ response.name+`"
                                class="rounded-circle avatar-members"
                                height="43"
                                alt=""
                                />
                            </div>
                            <div class="col-7">
                                <p class="text-dark" style="margin-bottom: -5px;">
                                    `+ response.name+`
                                </p>
                                <small>`+ response.role_member+`</small>
                            </div>
                            <div class="col-2 pt-2">
                                <button 
                                type="button"
                                data-id = "`+response.id +`"
                                data-token = "{{ csrf_token() }}"
                                data-url="/my-project/delete-task-member/`+response.id +`"
                                data-name="`+ response.name+`"
                                class="btn button_delete rounded-circle btn-sm py-0 btn-outline-danger"
                                >
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    `
                    )
                }
            },
            error: function(response){
                alert('Failed')
                
            }
        })
    });
    
    
    // Untuk Hapus task member
    $(".task-members").on('click','.button_delete', function (event) {
        
        let id = $(this).data('id');
        let token = $(this).data('token');
        let url = $(this).data('url');
        let task_members = $(this);
        let name = $(this).data('name');
        
        swal({
            title: 'Are you sure?',
            text: name + ' will be removed from the project',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        "_method" : 'DELETE',
                        "_token" : token,
                        "id" : id
                        
                    },
                    dataType : "JSON",
                    success: function (response){
                        
                        swal(response.success, {
                            icon: 'success',
                        });
                        
                        $(task_members).closest('.task-members').remove()
                    }
                    
                })
                
                
            } 
        });
    });
    //  Hapus task member
    $(".hidden-form").on('click','.button_delete', function (event) {
        
        let id = $(this).data('id');
        let token = $(this).data('token');
        let url = $(this).data('url');
        let task_members = $(this);
        let name = $(this).data('name');
        
        swal({
            title: 'Are you sure?',
            text: name + ' will be removed from the project',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        "_method" : 'DELETE',
                        "_token" : token,
                        "id" : id
                        
                    },
                    dataType : "JSON",
                    success: function (response){
                        
                        swal(response.success, {
                            icon: 'success',
                        });
                        
                        $(task_members).closest('.task-members').remove()
                    }
                    
                })
                
                
            } 
        });
    });
    
    form_upload_file = $('.form-upload-file');
    form_upload_file.hide()
   
    $('#attachmentButton').click(function(){
        form_upload_file.show()
         $('#cancelButton').click(function(){
        form_upload_file.hide()
         })
    })

    $('.description').on('focus', function(e){
        $('.btn-save-description').show()
        $('.btn-cancel-description').show()
    })
    
    $('.btn-cancel-description').click(function(){
        $('.btn-save-description').hide()
        $('.btn-cancel-description').hide()
    })
    
    $btn = $('#change-status');
    $btn.hide();
    $('.boards_id').on('change', function() {
        $btn.hide();
        $('.boards_id').each(function() {
            if ($(this).val() != 0) {
                $btn.show();
                return false;
            }
        });
    });
    
    
})
</script>