@extends('layouts.admin')
@section('title', 'Log Activity')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="container">
        <div class="row">
        
          <div class="col-12">
            <h3 class="text-dark mb-3">Log Activity {{ $item->project_name }}</h3>
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
                  Log Activity
                </li>
              </ol>
            </nav>
          </div>
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
                            <a href="{{ route('project-roadmap',$log->projects_id) }}" class="dropdown-item has-icon"><i class="material-icons text-small">compare_arrows</i> Roadmap</a>
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
</section>

</div>


@endsection

