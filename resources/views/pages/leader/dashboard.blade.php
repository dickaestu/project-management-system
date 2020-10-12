@extends('layouts.leader')
@section('title', 'Overview')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <h3 class="text-dark mb-2">Project Overview</h3>
        {{-- <p class="text-muted" style="font-size: 16px;">Project Overview </p> --}}
      </div>
      
    </div>
    
    {{-- Card Bagian Atas --}}
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon l-bg-purple">
            <i class="fas fa-suitcase"></i>
          </div>
          <div class="card-wrap">
            <div class="padding-20">
              <div class="text-right">
                <h3 class="font-light mb-0">
                  <i class="ti-arrow-up text-success"></i> {{ $project_on_progress }}
                </h3>
                <span class="text-muted">Project On Progress</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon l-bg-green">
            <i class="fas fa-check"></i>
          </div>
          <div class="card-wrap">
            <div class="padding-20">
              <div class="text-right">
                <h3 class="font-light mb-0">
                  <i class="ti-arrow-up text-success"></i> {{ $project_completed }}
                </h3>
                <span class="text-muted">Project Completed</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon l-bg-cyan">
            <i class="fas fa-clock"></i>
          </div>
          <div class="card-wrap">
            <div class="padding-20">
              <div class="text-right">
                <h3 class="font-light mb-0">
                  <i class="ti-arrow-up text-success"></i> {{ $project_pending }}
                </h3>
                <span class="text-muted">Project Pending</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon l-bg-orange">
            <i class="fas fa-times"></i>
          </div>
          <div class="card-wrap">
            <div class="padding-20">
              <div class="text-right">
                <h3 class="font-light mb-0">
                  <i class="ti-arrow-up text-success"></i> {{ $project_abandoned }}
                </h3>
                <span class="text-muted">Project Abandoned</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      {{-- Project mendekati deadline --}}
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="d-inline text-black-50">This project is approaching the deadline.</h4>
          </div>
          <div class="card-body" style="max-height:400px; overflow:auto">
            <div class="table-responsive">
              <table class="table table-borderless">
                <tr class="text-small">
                  <th>Project Name</th>
                  <th>Client Name</th>
                  <th>Project  Manager</th>
                  <th>Deadline Date</th>
                  <th>View Project</th>
                </tr>
                @forelse ($deadline_project as $project)
                <tr>
                  <td>{{ $project->project_name }}</td>
                  <td>{{ $project->client_name }}</td>
                  <td>{{ $project->user->name }}</td>
                  <td>{{ Carbon\Carbon::parse($project->end)->format('d, M Y') }}</td>
                  <td><a href="#" class="btn btn-sm btn-info">Details</a></td>
                </tr>
                @empty 
                <tr>
                  <td colspan="5" class="text-center">Data is empty</td>
                </tr>
                @endforelse
              </table>
            </div>
          </div>
        </div>
      </div>

      {{-- Project On Progress --}}
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="d-inline text-black-50">This project is on progress.</h4>
          </div>
          <div class="card-body" style="max-height:400px; overflow:auto">
            <div class="table-responsive">
              <table class="table table-borderless">
                <tr class="text-small">
                  <th>Project Name</th>
                  <th>Client Name</th>
                  <th>Project  Manager</th>
                  <th>Deadline Date</th>
                  <th>View Project</th>
                </tr>
                @forelse ($projects as $item)
                <tr>
                  <td>{{ $item->project_name }}</td>
                  <td>{{ $item->client_name }}</td>
                  <td>{{ $item->user->name }}</td>
                  <td>{{ Carbon\Carbon::parse($item->end)->format('d, M Y') }}</td>
                  <td><a href="#" class="btn btn-sm btn-info">Details</a></td>
                </tr>
                @empty 
                <tr>
                  <td colspan="5" class="text-center">Data is empty</td>
                </tr>
                @endforelse
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </section>
</div>


@endsection

