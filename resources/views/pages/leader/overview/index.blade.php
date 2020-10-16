@extends('layouts.leader')
@section('title', 'Project Overview')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <h3 class="text-dark mb-2">Project Overview ({{ $item->project_name }})</h3>
        {{-- <p class="text-muted" style="font-size: 16px;">Project Overview </p> --}}
      </div>  
    </div>
    
    
    <div class="row">
      <div class="col p-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item">
              <a href="{{ route('project-leader') }}">Project</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Overview
            </li>
          </ol>
        </nav>
      </div>
    </div>
    
    <div class="row d-lg-none  mb-3">
      <div class="col">
        <a href="{{ route('log-activity-leader',$item->id) }}"
          class="btn btn-info btn-sm text-primary"  
          >
          <i class="fas fa-history"></i>  Log Activity
        </a>
      </div>
    </div>
    
    <div class="card">
      <div class="card-header"><h4>Roadmap</h4></div>
      <div class="card-body">
        <div class="row roadmap-content">
          
          <svg id="gantt"></svg>
        </div>
        
        <div class="row mt-3">
          <div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
            <button id="btnDay" type="button" class="btn btn-primary">Day</button>
            <button id="btnWeek" autofocus type="button" class="btn btn-primary">Week</button>
            <button id="btnMonth" type="button" class="btn btn-primary">Month</button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-12">
        <div class="card ">
          <div class="card-header bg-primary">
            <h4 class="text-white">List Task</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="tableListTask">
                <thead>
                  <tr>
                    <th class="text-center">
                      #
                    </th>
                    <th>Task Name</th>
                    <th>Board</th>
                    <th>Tags</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tasks as $task)
                  <tr
                  @if($deadline_day > $task->due_date)
                  class="bg-danger text-white"
                  @elseif ($h_3 >= $task->due_date)
                  class="bg-warning text-white"
                  @endif>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $task->task_name }}</td>
                  <td>{{ $task->board->board_name }}</td>
                  <td><span class="badge badge-{{ $task->tags_color }} badge-sm">{{ $task->tags }}</span></td>
                  <td>{{ Carbon\Carbon::parse($task->start_date)->format('d, F Y') }}</td>
                  <td>{{ Carbon\Carbon::parse($task->due_date)->format('d, F Y') }}</td>
                  <td><a href="#" data-toggle="modal" class="btn btn-info btn-sm"
                    data-remote="{{ route('show-task-leader', $task->id) }}"
                    data-target=".bd-example-modal-lg">Show Task</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </section>
</div>


{{-- Log activity --}}
<div class="settingSidebar">
  <a href="javascript:void(0)" class="settingPanelToggle"><i class="fas fa-history"></i> 
  </a>
  <div class="settingSidebar-body ps-container ps-theme-default">
    <div class=" fade show active">
      <div class="setting-panel-header">Log Activity <a class="text-small text-decoration-none" href="{{ route('log-activity-leader',$item->id) }}"><i class="fas fa-eye"></i></a>
      </div>
      {{-- Content --}}
      <div class="container">
        <section class="section">
          <div class="section-body">
            <h2 class="section-title"></h2>
            <div class="row">
              <div class="col-12">
                <div class="activities">
                  
                  @forelse ($logs as $log)
                  <div class="activity">
                    <div class="activity-icon bg-info text-white">
                      {!! $log->activity_icon !!}
                    </div>
                    <div class="activity-detail">
                      <div class="mb-2">
                        <span class="text-job">{{ $log->created_at->diffForHumans() }}</span>
                        <div class="float-right dropdown">
                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu">
                            <div class="dropdown-title">Options</div>
                            <a href="{{ route('project-board-leader',$log->projects_id) }}" class="dropdown-item has-icon"><i class="material-icons text-small">assignment</i> Board</a>
                            <a href="{{ route('project-roadmap-leader',$log->projects_id) }}" class="dropdown-item has-icon"><i class="material-icons text-small">compare_arrows</i> Roadmap</a>
                          </div>
                        </div>
                      </div>
                      <p>{{ $log->activity }}</p>
                    </div>
                  </div>
                  @empty
                  <p>No Activites</p>
                  @endforelse
                  
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      {{-- End of Content --}}
    </div>
  </div>
</div>

@endsection

@push('addon-style')
<link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.5.0/frappe-gantt.min.css">
@endpush

@push('addon-script')

<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/frappe-gantt.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.5.1/snap.svg-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
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
        text: 'This task will be deleted permanently',
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
    $(function(){
      $('.board-name').on('click','.edit-board',function(e){
        let text = $(this).parent().find('p').text();
        let id = $(this).parent().find('p').data('id');
        
        $(this).parent().html(`
        <div class="container input-board-name">
          <div class="row mb-3" data-id="${id}">
            <form action="/leader/board/${id}/edit" class="d-flex" method="post">
              @method('PUT')
              @csrf
              <input type="text" name="board_name" class="form-control form-control-sm" value="${text}">
              <button  class="btn btn-success ml-2 btn-sm"><i class="fas fa-check"></i></button>
            </form>
            <a href="#" class="btn btn-secondary ml-1 btn-sm btn-close"><i class="fas fa-times"></i></a>
          </div>
        </div>
        `);
        
        
      });
      
      $('.board-name').on('click', '.btn-close', function(e){
        let text2 = $(this).parent().find("input[name='board_name']").val();
        let id2 = $(this).parent().data('id');
        $(this).parent().parent().parent().html(`
        <p data-id="${id2}" style="font-weight: 600; font-size: 17px;"
        class="text-dark">${text2}</p>
        <a href="#" class="edit-board ml-1 mr-1"><i class="fas fa-pencil-alt text-warning"></i></a>
        <a href="#" 
        data-url="/leader/board/${id2}/delete"
        class="delete-board"><i class="fas fa-trash text-danger"></i></a>
        `)
      })
    });
    
    $("#tableListTask").dataTable({
      
    });
    
    
    // Roadmap
    var listTask = {!! $listTask!!};
    if(typeof(listTask) == 'object'){
      
      var tasks = listTask.map(function(item){
        return {
          id: item.id.toString(),
          name: item.task_name,
          start: item.start_date,
          end: item.due_date,
          progress: 100,
        }
      });
      
      
      var gantt = new Gantt("#gantt", tasks, {
        // on_click: function (task) {
          //   console.log(task);
          // },
          
          
          
          custom_popup_html: function(task) {
            const end =  moment(task.end).format('LL');
            return `
            <div class="p-4 rounded bg-primary" style="width:180px">
              <h5 class="text-light">${task.name}</h5>
              <p class="text-light">Expected to finish by ${end}</p>
              
              <a 
              class ="btn btn-info btn-sm"
              href="#modalRoadmap"
              data-remote="/leader/roadmap/tasks/${task.id}"
              data-toggle="modal"
              data-target="#modalRoadmap"
              data-title="${task.name}"
              >Edit Date
            </a>
            
          </div>
          `;
        }
        
        
      });
      gantt.change_view_mode('Week')
      
      $('#btnDay').click(function(){
        gantt.change_view_mode('Day')
      });
      $('#btnWeek').click(function(){
        gantt.change_view_mode('Week')
      });
      $('#btnMonth').click(function(){
        gantt.change_view_mode('Month')
      });
      
    } else{
      $('.roadmap-content').html(
      `
      <div class="col-12 text-center mt-3">
        <img src="{{ asset('assets/img/no-project.svg') }}" height="250" class="mb-3">
        <h5>Roadmap Is Empty</h5>
      </div>
      `
      )
    }
    
  });
</script>

@endpush