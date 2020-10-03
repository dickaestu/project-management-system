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
        <div class="row roadmap-content">
          
          <svg id="gantt"></svg>
        </div>
        
        
      </div>
    </div>
  </section>
  
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
          <div class="p-4 rounded bg-primary" style="width:150px">
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
