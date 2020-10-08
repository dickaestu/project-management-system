@extends('layouts.main')
@section('title', 'Project Board')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <h3 class="text-dark mb-2">Dashboard</h3>
        <p class="text-muted" style="font-size: 16px;">Project Overview </p>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
          <div class="card-statistic-4 car">
            <div class="align-items-center justify-content-between">
              <div class="row">
                <div
                class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
                >
                <div class="card-content">
                  <h2 class="font-18">{{ $pending_project }}</h2>
                  <h2 class="mb-3 font-15">Pending Project</h2>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="{{ asset('assets/img/banner/5.png') }}" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row">
              <div
              class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
              >
              <div class="card-content">
                <h2 class="font-18">{{ $progress_project }}</h2>
                <h2 class="mb-3 font-15">Project On Progress</h2>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
              <div class="banner-img">
                <img src="{{ asset('assets/img/banner/6.png') }}"  alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="card">
      <div class="card-statistic-4">
        <div class="align-items-center justify-content-between">
          <div class="row">
            <div
            class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
            >
            <div class="card-content">
              <h5 class="font-18">{{ $total_project }}</h5>
              <h2 class="mb-3 font-15">Total Project</h2>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
            <div class="banner-img">
              <img src="{{ asset('assets/img/banner/7.png') }}"  alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="card">
    <div class="card-statistic-4">
      <div class="align-items-center justify-content-between">
        <div class="row">
          <div
          class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
          >
          <div class="card-content">
            <h2 class="font-18">{{ $completed_project }}</h2>
            <h2 class="mb-3 font-15">Completed Project</h2>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
          <div class="banner-img">
            <img src="{{ asset('assets/img/banner/8.png') }}"  alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<div class="row">
  <div class="col-12 col-sm-12 col-lg-6">
    <div class="card">
      <div class="card-header" style="background: #8eb8c9;">
        <div class="row">
          <div class="col-12">
            <h4 class="text-white">Due Tasks</h4>
            <p class="text-white" style="line-height: 20px">This is a task that is approaching the deadline for a task that you have not completed.</p>
          </div>
        </div>
      </div>
      
      <div class="card-body">
       @forelse ($due_tasks as $due_task)
        <div class="row">
          <div class="col-8">
            <h6 class="card-title mb-1">{{ $due_task->board->project->project_name }}</h6>
            <p class="text-muted mb-0">{{ $due_task->task_name }}</p>
            <p>Due Date: {{ Carbon\Carbon::parse($due_task->due_date)->format('d, F Y') }}</p>
          </div>
          <div class="col-4">
            <a href="{{ route('project-board',$due_task->board->projects_id) }}" class="text-info text-decoration-none ">View Details</a>
          </div>
        </div>
        <hr>
        @empty
        <p>No Tasks...</p>
        @endforelse
      </div>
    </div>
  </div>
  
  <div class="col-12 col-sm-12 col-lg-6">
    <div class="card">
      <div class="card-header" style="background: #8eb8c9;">
        <div class="row">
          <div class="col-12">
            <h4 class="text-white">In Going Task</h4>
            <p class="text-white">These are the tasks you are currently working on.</p>
          </div>
        </div>
      </div>
      
      <div class="card-body">
        @forelse ($in_going_tasks as $task)
        <div class="row">
          <div class="col-8">
            <h6 class="card-title mb-1">{{ $task->board->project->project_name }}</h6>
            <p class="text-muted mb-0">{{ $task->task_name }}</p>
            <p>Due Date: {{ Carbon\Carbon::parse($task->due_date)->format('d, F Y') }}</p>
          </div>
          <div class="col-4">
            <a href="{{ route('project-board',$task->board->projects_id) }}" class="text-info text-decoration-none ">View Details</a>
          </div>
        </div>
        <hr>
        @empty 
        <p>No Tasks...</p>
        @endforelse
      </div>
    </div>
  </div>
  
</div>
  </section>
</div>


@endsection

