@extends('layouts.admin')
@section('title', 'Manage Users')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <h3 class="text-dark mb-2">Manage Users</h3>
                <p class="text-muted" style="font-size: 16px;">List Users</p>
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
        
        <a href="{{ route('manage-users.create') }}" class="btn btn-icon icon-left btn-primary btn-sm mb-3"><i class="fas fa-plus"></i> Create User</a>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Users Table</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableUsers">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->roles }}</td>
                                        <td>
                                            <a href="{{ route('manage-users.edit',$item->id) }}" class="btn btn-icon icon-left btn-info btn-sm"><i class="fas fa-pencil-alt"></i>Edit</a>
                                           <form class="d-inline-block" action="{{ route('manage-users.destroy',$item->id) }}" method="post">
                                               @csrf
                                               @method('DELETE')
                                                <button type="submit" class="btn btn-icon icon-left btn-danger btn-sm"><i class="fas fa-trash"></i>Delete</button>
                                           </form>
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
            $("#tableUsers").dataTable({
            // "columnDefs": [
            // { "sortable": false, "targets": [2, 3] }
            // ]
        });
        })
    </script>
@endpush
