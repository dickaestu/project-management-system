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




<div class="modal" id="modalRoadmap" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        
      </div>
    </div>
  </div>
  
  
  @endsection
  
  @push('addon-style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.5.0/frappe-gantt.min.css">
  @endpush
  
  @push('addon-script')
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.5.0/frappe-gantt.min.js"></script> --}}
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
          on_click: function (task) {
            console.log(task);
          },
          
          custom_popup_html: function(task) {
            $.ajax({
              url: "/my-project/roadmap/tasks/"+task.id,
              type: 'GET',
              dataType: 'json', // added data type
              success: function(response) {
                var modal = $('#modalRoadmap');
                modal.modal('show');
                modal.find('.modal-title').html(response.task_name);
                modal.find('.modal-body').html(`
                <form action="/my-project/roadmap/tasks/edit/`+response.id+`" method="post">
                  @method('PUT')
                  @csrf

                  <form-group>
                    <label>Start Date</label>
                    <input name="start_date" class="form-control form-control-sm start-date-edit" type="date" value="`+response.start_date+`">
                  </form-group>
                  
                  <form-group>
                    <label>Due Date</label>
                    <input name="due_date" class="form-control form-control-sm due-date-edit" type="date" value="`+response.due_date+`">
                  </form-group>

                </div>
                <div class="modal-footer mt-3">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
              </div>
              `);
            }
          });
          
          
          
          return ``;
          
        }
      });
      gantt.change_view_mode('Day')
      
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
