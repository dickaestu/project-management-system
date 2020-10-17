@extends('layouts.main')
@section('title', 'Project Board')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <h3 class="text-dark mb-2">Archived Project</h3>
        {{-- <p class="text-muted" style="font-size: 16px;">Project Overview </p> --}}
      </div>
    </div>

    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableArchivedProject">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Project Name</th>
                                        <th>Client Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Deleted Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->project_name }}</td>
                                        <td>{{ $item->client_name }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->start)->format('d, F Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->end)->format('d, F Y') }}</td>
                                        <td>{{$item->deleted_at->format('d, F Y')}}</td>
                                        <td>
                                            <a href="{{ route('restore-project',$item->id) }}" class="btn btn-icon icon-left btn-primary btn-sm"><i class="fas fa-history"></i>Restore</a>
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
            $("#tableArchivedProject").dataTable({
            // "columnDefs": [
            // { "sortable": false, "targets": [2, 3] }
            // ]
        });
        })
    </script>
@endpush
