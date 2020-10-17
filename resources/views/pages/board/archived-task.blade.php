@extends('layouts.main')
@section('title', 'Archived Task')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <h3 class="text-dark mb-2">Archived Tasks</h3>
        {{-- <p class="text-muted" style="font-size: 16px;">Project Overview </p> --}}
      </div>
    </div>
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
    <div class="row">
          <div class="col p-0">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item">
                  <a href="{{ route('project-board',$project_id) }}">Back to board</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Archived Task
                </li>
              </ol>
            </nav>
          </div>
        </div>
    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableArchivedTasks">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Tasks Name</th>
                                        <th>Start Date</th>
                                        <th>Due Date</th>
                                        <th>Deleted Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->task_name}}</td>
                                        <td>{{ Carbon\Carbon::parse($item->start_date)->format('d, F Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->due_date)->format('d, F Y') }}</td>
                                        <td>{{$item->deleted_at->format('d, F Y')}}</td>
                                        <td>
                                            <a href="{{ route('restore-task',$item->id) }}" class="btn btn-icon icon-left btn-primary btn-sm"><i class="fas fa-history"></i>Restore</a>
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

  </section>
</div>


@endsection


@push('addon-script')

<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#tableArchivedTasks").dataTable({
            // "columnDefs": [
            // { "sortable": false, "targets": [2, 3] }
            // ]
        });
        })
    </script>
@endpush
