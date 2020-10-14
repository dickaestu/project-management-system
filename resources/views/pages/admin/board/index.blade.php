@extends('layouts.admin')
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
                  <a href="{{ route('dashboard-admin') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  {{ $item->project_name }} Board
                </li>
              </ol>
            </nav>
          </div>
        </div>
      
     
      <div class="row d-lg-none  mb-3">
        <div class="col">
          <a href="{{ route('log-activity-admin',$item->id) }}"
          class="btn btn-info btn-sm text-primary"  
          >
          <i class="fas fa-history"></i>  Log Activity
        </a>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="scrolling-wrapper">
      @forelse ($boards as $board)
      <!-- Board card -->
      <div class="card bg-light align-top" style="width: 320px;">
        <div class="card-body">
          <div class="row board-name">
            <p style="font-weight: 600; font-size: 17px;"
            class="text-dark">{{ $board->board_name }}</p>
          </div>
        <!-- Board task -->
        @forelse ($board->board_task as $task)
        <div class="row mb-3 task">
          <div class="board-content">
            <div class="row mb-4">
              <div class="col-8">
                <a href="#" style="text-decoration: none" 
                data-toggle="modal"
                data-remote="{{ route('show-task-admin', $task->id) }}"
                data-target=".bd-example-modal-lg">
                <p>
                  {{ $task->task_name }} 
                </p>
              </a><span class="badge badge-{{ $task->tags_color }} badge-sm">{{ $task->tags }}</span>
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

{{-- Log activity --}}
<div class="settingSidebar">
  <a href="javascript:void(0)" class="settingPanelToggle"><i class="fas fa-history"></i> 
  </a>
  <div class="settingSidebar-body ps-container ps-theme-default">
    <div class=" fade show active">
      <div class="setting-panel-header">Log Activity <a class="text-small text-decoration-none" href="{{ route('log-activity-admin',$item->id) }}"><i class="fas fa-eye"></i></a></div> 
      {{-- Content --}}
      <div class="container mb-5">
        <section class="section">
          <div class="section-body">
            <h2 class="section-title"></h2>
            <div class="row ">
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
                            <a href="#" class="dropdown-item has-icon"><i class="material-icons text-small">assignment</i> Board</a>
                            <a href="{{ route('project-roadmap-admin',$log->projects_id) }}" class="dropdown-item has-icon"><i class="material-icons text-small">compare_arrows</i> Roadmap</a>
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
@endpush

@push('addon-script')
<script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>


@endpush