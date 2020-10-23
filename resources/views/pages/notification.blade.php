@extends('layouts.main')
@section('title', 'All Notification')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <h3 class="text-dark mb-4">All Notification</h3>
                {{-- <p class="text-muted" style="font-size: 16px;">Project Overview </p> --}}
            </div>
        </div>
        
        <a href="#" class="btn btn-success mb-3 mark-all-read"> Mark All As Read</a>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableNotifications">
                                <thead>
                                    
                                    <tr>
                                        <th>#</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Read</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($notifications as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->data['message']}}</td>
                                        <td>asad</td>
                                        <td>{{ $item->read_at == null ? 'Not Read' : 'Already Read' }}</td>
                                        <td><a href="{{ route('project-board',$item->data['projects_id']) }}" class="btn btn-sm btn-primary">See Project</a></td>
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
        $("#tableNotifications").dataTable({
            // "columnDefs": [
            // { "sortable": false, "targets": [2, 3] }
            // ]
        });
        
        
        $(".mark-all-read").click(function(){
            const id = "{{ Auth::id() }}";
       
            $.ajax({
                type: "GET",
                url: "/notification-members/mark-all-read/"+id,
                cache: false,
                success: function(data){
                    location.reload()
                }
            });
        });
    })
</script>
@endpush
