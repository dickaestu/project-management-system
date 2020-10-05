@extends('layouts.main')
@section('title', 'Project Board')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3 class="text-dark mb-3">{{ $item->project_name }} Board</h3>
          </div>
        </div>
        <div class="row">
          <div class="col p-0">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item">
                  <a href="{{ route('my-project.index') }}">My Project</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  {{ $item->project_name }} Board
                </li>
              </ol>
            </nav>
          </div>
        </div>
        @if ($item->project_manager == Auth::id())
        <div class="row mb-3">
          <div class="col">
            <button
            class="btn btn-primary btn-sm text-primary" type="button" data-toggle="modal" data-target="#createBoard" 
            >
            <i class="fas fa-plus"></i> Create Board
          </button>
        </div>
      </div>
      @endif
      <div class="scrolling-wrapper">
        @forelse ($boards as $board)
        <!-- Board card -->
        <div class="card bg-light align-top" style="width: 320px;">
          <div class="card-body">
            <div class="row board-name">
              <p
              style="font-weight: 600; font-size: 17px;"
              class="text-dark "
              >
              {{ $board->board_name }} 
              <a href="#" class="edit-board"><i class="fas fa-pencil-alt text-warning"></i></a>
              <a href="#" 
              data-url="{{ route('delete-board', $board->id) }}"
              class="delete-board"><i class="fas fa-trash text-danger"></i></a>
              
            </p>
            
          </div>
          <div class="row input-board-name mb-2">
            <form action="{{ route('edit-board',$board->id) }}" class="form-inline" method="post">
              @method('PUT')
              @csrf
              <input type="text" name="board_name" class="form-control form-control-sm" value="{{ $board->board_name }}">
              <button  class="btn btn-success ml-2 btn-sm"><i class="fas fa-check"></i></button>
            </form>
            <a href="#" class="btn btn-secondary ml-1 btn-sm btn-close"><i class="fas fa-times"></i></a>
          </div>
          <!-- Board task -->
          
          @forelse ($board->board_task as $task)
          <div class="row mb-3 task">
            <div class="board-content">
              <div class="row mb-4">
                <div class="col-8">
                  <a href="" style="text-decoration: none" 
                  data-toggle="modal"
                  data-remote="{{ route('show-task', $task->id) }}"
                  data-title="{{ $task->task_name }}"
                  data-target=".bd-example-modal-lg">
                  <p>
                    {{ $task->task_name }} 
                  </p>
                </a><span class="badge badge-{{ $task->tags_color }} badge-sm">{{ $task->tags }}</span>
              </div>
              <div class="col-4 text-right">
                <div class="dropdown dropright">
                  <a
                  href="#"
                  class="text-dark"
                  type="button"
                  id="dropdownMenuButton2"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                  >
                  <i class="material-icons">more_vert</i>
                </a>
                <div class="dropdown-menu">
                  <a
                  class="dropdown-item archive-task-button has-icon"
                  data-url="{{ route('archive-task', $task->id) }}"
                  href="#"
                  ><i class="material-icons">archive</i> Archive Task</a>

                  <a class="dropdown-item has-icon delete-task-button text-danger" href="#"
                  data-url="{{ route('delete-task', $task->id) }}"
                  ><i class="material-icons">delete</i> Delete</a
                  >
                </div>
              </div>
            </div>
            
          </div>
          <div class="row">
            <div class="col-12">
              <p class="assigned-to mb-2">
                Assigned To
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              @foreach ($task->task_member as $member)
              <div class="assigned-profile mb-2">
                <img
                src="https://ui-avatars.com/api/?name={{ $member->project_members->user->name }}"
                class="rounded-circle border"
                height="30"
                alt=""
                data-toggle="tooltip"
                data-original-title="{{ $member->project_members->user->name }}"
                />
              </div>
              @endforeach
              
            </div>
          </div>
        </div>
        
      </div>
      @empty 
      <div class="row mb-3">
        <div class="board-content">
          <div class="row">
            <div class="col-12 pt-2">
              
              <p class="text-center">
                Tasks is empty
              </p>
              
            </div>
          </div>
        </div>
        
      </div>
      
      @endforelse
      
      <!-- Button create task -->
     
      <div class="row justify-content-center">
        <a
        style="text-decoration:none;" class="text-black-50" href="#" type="button" 
        data-toggle="modal" 
        data-target="#createTask" 
        data-remote="{{ route('show-create-task', $board->id) }}"
        data-title="Create Task"
        >
        <i class="fas fa-plus"></i> Create Task
      </a>
    </div>
    
    
  </div>
</div>

@empty 

<div class="col-12 text-center">
  <img src="{{ asset('assets/img/no-project-file.svg') }}" height="200" class="my-3">
  <h5 class="mb-0 mt-3 mb-5">Board Is Empty</h5>
</div>



<!-- End of board -->

@endforelse
</div>
</div>
</div>
</section>

</div>





<!-- Create Board Modal -->
<div class="modal fade" id="createBoard" tabindex="-1" role="dialog" aria-labelledby="formModal"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="formModal">Create Board</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form action="{{ route('create-board',$item->id) }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="board_name" class="form-control" placeholder="Board Name">
        </div>
        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Create</button>
      </form>
    </div>
  </div>
</div>
</div>

@endsection


@push('addon-style')
<link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}">
@endpush

@push('addon-script')
<script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
<script>
  $(document).ready(function(){
    // Untuk Archive task
    $(".task").on('click','.archive-task-button', function (event) {
      
      let token = "{{ csrf_token() }}";
      let url = $(this).data('url');
      let task = $(this);
      swal({
        title: 'Are you sure?',
        text: 'This task will be archived',
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
              
              $(task).closest('.task').remove()
            }
            
          })
          
          
        } 
      });
    });

    // Untuk Hapus task
    $(".task").on('click','.delete-task-button', function (event) {
      
      let token = "{{ csrf_token() }}";
      let url = $(this).data('url');
      let task = $(this);
      swal({
        title: 'Are you sure?',
        text: 'This task will be removed',
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
              
              $(task).closest('.task').remove()
            }
            
          })
          
          
        } 
      });
    });
    // Untuk Hapus board
    $(".board-name").on('click','.delete-board', function (event) {
      
      let token = "{{ csrf_token() }}";
      let url = $(this).data('url');
      let board = $(this);
      swal({
        title: 'Are you sure?',
        text: 'This board will be removed',
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
                button:false
                
              });
              
              setTimeout(function() {
                location.reload()
              }, 1300);
            }
            
          })
          
          
        } 
      });
    });
    
    // Untuk Edit Board
    let board_name = $('.board-name');
    var input_board_name = $('.input-board-name');
    input_board_name.hide()
    $('.edit-board').click(function(){
      board_name.hide()
      input_board_name.show()
      input_board_name.find('input').focus()
    })
    
    input_board_name.find('.btn-close').click(function(){
      board_name.show()
      input_board_name.hide()
    })
    
  })
</script>

@endpush