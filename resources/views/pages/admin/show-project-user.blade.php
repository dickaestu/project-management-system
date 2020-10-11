<div id="accordion">
    <div class="accordion">
        <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1">
        <h4>As A Project Manager</h4>
    </div>
    <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Status</th>
                </tr>
                @forelse ($project_managers as $pm)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pm->project_name }}</td>
                    <td> <div class="badge  
                    @if($pm->project_status == 'Pending')
                    badge-light
                    @elseif($pm->project_status == 'In Progress')
                    badge-secondary
                    @elseif($pm->project_status == 'Completed')
                    badge-success
                    @elseif($pm->project_status == 'Abandoned')
                    badge-danger
                    @endif badge-shadow">{{ $pm->project_status }}</div></td>
                </tr>
                @empty 
                <tr>
                    <td colspan="3" class="text-center">Data is empty</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
<div class="accordion">
    <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-2">
        <h4>As A Member</h4>
    </div>
    <div class="accordion-body collapse" id="panel-body-2" data-parent="#accordion">
           <div class="table-responsive">
            <table class="table table-striped" >
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Status</th>
                </tr>
                @forelse ($members as $member)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $member->project_name }}</td>
                    <td> <div class="badge  
                    @if($member->project_status == 'Pending')
                    badge-light
                    @elseif($member->project_status == 'In Progress')
                    badge-secondary
                    @elseif($member->project_status == 'Completed')
                    badge-success
                    @elseif($member->project_status == 'Abandoned')
                    badge-danger
                    @endif badge-shadow">{{ $member->project_status }}</div></td>
                </tr>
                 @empty 
                <tr>
                    <td colspan="3" class="text-center">Data is empty</td>
                </tr>
                @endforelse
            </table>
        </div>
        </div>
    </div>
    </div>