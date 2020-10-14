@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <h3 class="text-dark mb-2">Dashboard Admin</h3>
        <p class="text-muted" style="font-size: 16px;">Project Overview </p>
      </div>
    </div>
    
    <div class="row">
      <div class="col-12">
        <div class="card ">
          <div class="card-header bg-primary">
            <h4 class="text-white">List Project</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="tableProject">
                <thead>
                  <tr>
                    <th class="text-center">
                      #
                    </th>
                    <th>Project Name</th>
                    <th>Project Manager</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                  <tr>
                    <td>
                      {{ $loop->iteration }}
                    </td>
                    <td>{{ $item->project_name }}</td>
                    <td>
                      {{ $item->user->name }}
                    </td>
                    <td>{{ Carbon\Carbon::parse($item->start)->format('d, F Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($item->end)->format('d, F Y') }}</td>
                    <td>
                      <div class="badge  
                      @if($item->project_status == 'Pending')
                      badge-light
                      @elseif($item->project_status == 'In Progress')
                      badge-secondary
                      @elseif($item->project_status == 'Completed')
                      badge-success
                      @elseif($item->project_status == 'Abandoned')
                      badge-danger
                      @endif badge-shadow">{{ $item->project_status }}</div>
                    </td>
                    <td>
                      <div class="dropdown dropleft d-inline">
                        <button class="btn btn-primary" type="button" id="dropdownMenuButton2" data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        >
                        <i class="fas fa-eye"></i> Detail
                      </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item has-icon"
                             href="#modalDetailProjectMember"
                            data-remote="{{ route('show-project-member', $item->id) }}"
                            data-toggle="modal"
                            data-target="#modalDetailProjectMember"
                            data-title="Detail Member"
                            ><i class="fas fa-users"></i>Detail Member</a>
                            <a class="dropdown-item has-icon" href="#"
                              ><i class="fas fa-clone"></i> Board</a>
                              <a class="dropdown-item has-icon" href="#"
                                ><i class="fas fa-exchange-alt"></i> Roadmap</a>
                                <a class="dropdown-item has-icon" href="#"
                                  ><i class="fas fa-folder"></i> Project File</a>
                          </div>
                      </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          {{-- Total Project User --}}
          <div class="col-12 col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h4>Total Project User</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="tableProjectUser">
                    <thead>
                      <tr>
                        <th class="text-center">
                          #
                        </th>
                        <th>Name</th>
                        <th>Total Project</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($projects as $project)
                      <tr>
                        <td>
                          {{ $loop->iteration }}
                        </td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->total }}</td>
                        <td><a
                          href="#modalProjectUser"
                          data-remote="{{ route('show-project-user', $project->id) }}"
                          data-toggle="modal"
                          data-target="#modalProjectUser"
                          data-title="Detail Project User" 
                          class="btn btn-info">Show</a></td>
                        </tr>
                        @empty
                        <tr>
                          <td colspan="4" class="text-center">Data is empty</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            {{-- Total Task User --}}
            <div class="col-12 col-md-6">
              <div class="card card-info">
                <div class="card-header">
                  <h4>Total Task User</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped" id="tableTaskUser">
                      <thead>
                        <tr>
                          <th class="text-center">
                            #
                          </th>
                          <th>Name</th>
                          <th>Total Task</th>
                          <th>Detail</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($tasks as $task)
                        <tr>
                          <td>
                            {{ $loop->iteration }}
                          </td>
                          <td>{{ $task->name }}</td>
                          <td>{{$task->total}}</td>
                          <td><a
                            href="#modalTaskUser"
                            data-remote="{{ route('show-task-user', $task->id) }}"
                            data-toggle="modal"
                            data-target="#modalTaskUser"
                            data-title="Detail Task User" 
                            class="btn btn-info">Show</a></td>
                          </tr>
                          @empty 
                          <tr>
                            <td colspan="4" class="text-center">Data is empty</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
            
            
          </section>
        </div>
        
        
        @endsection
        
        
        
        @push('addon-script')
        
        <script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
        <script>
          $(document).ready(function(){
            $("#tableProject").dataTable({
              // "columnDefs": [
              // { "sortable": false, "targets": [2, 3] }
              // ]
            });
            $("#tableProjectUser").dataTable({
              // "columnDefs": [
              // { "sortable": false, "targets": [2, 3] }
              // ]
            });
            $("#tableTaskUser").dataTable({
              // "columnDefs": [
              // { "sortable": false, "targets": [2, 3] }
              // ]
            });
          })
        </script>
        @endpush
        