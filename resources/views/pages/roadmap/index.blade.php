@extends('layouts.main')
@section('title', 'Project Roadmap')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="container">
        <div class="row">
          <div class="col-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">
              <div class="alert-body">
                <button class="close" data-dismiss="alert">
                  <span>&times;</span>
                </button>
                {{ session('success') }}
              </div>
            </div>
            @endif
          </div>
          <div class="col-12">
            <h3 class="text-dark mb-3">Roadmap  {{ $item->project_name }}</h3>
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
                  Roadmap
                </li>
              </ol>
            </nav>
          </div>
        </div>
        
        <div class="row d-lg-none  mb-3">
          <div class="col">
            <a href="{{ route('log-activity',$item->id) }}"
              class="btn btn-info btn-sm text-primary"  
              >
              <i class="fas fa-history"></i>  Log Activity
            </a>
          </div>
        </div>
        
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
  </section>
  
</div>

{{-- Log activity --}}
<div class="settingSidebar">
  <a href="javascript:void(0)" class="settingPanelToggle"><i class="fas fa-history"></i> 
  </a>
  <div class="settingSidebar-body ps-container ps-theme-default">
    <div class=" fade show active">
      <div class="setting-panel-header">Log Activity <a class="text-small text-decoration-none" href="{{ route('log-activity',$item->id) }}"><i class="fas fa-eye"></i></a>
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
                            <a href="{{ route('project-board',$log->projects_id) }}" class="dropdown-item has-icon"><i class="material-icons text-small">assignment</i> Board</a>
                            <a href="#" class="dropdown-item has-icon"><i class="material-icons text-small">compare_arrows</i> Roadmap</a>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.5.0/frappe-gantt.min.css">
@endpush

@push('addon-script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.5.0/frappe-gantt.min.js"></script> --}}
<script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/frappe-gantt.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.5.1/snap.svg-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<script >
  $('document').ready(function(){
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
            <div class="p-4 rounded bg-primary" style="width:100%">
              <h5 class="text-light">${task.name}</h5>
              <p class="text-light">Expected to finish by ${end}</p>
              <a 
              class ="btn btn-info btn-sm"
              href="#modalRoadmap"
              data-remote="/my-project/roadmap/tasks/${task.id}"
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
    
    
  })
</script>
@endpush
