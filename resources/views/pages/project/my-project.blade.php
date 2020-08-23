@extends('layouts.main')
@section('title', 'My Project')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="container">
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
          <div class="col-12">
            <h3 class="text-dark mb-3">My Projects</h3>
          </div>
          
        </div>
        <div class="row mb-2 text-right">
          <div class="col-12">
            <a href="{{ route('my-project.create') }}" class="btn btn-success btn-sm shadow-sm"><i class="fas fa-plus"></i> Create Project</a>
          </div>
        </div>
        @foreach ($items as $item)
        <div class="row">
          <div class="col-12">
            <div class="card mb-5">
              <div class="row no-gutters">
                <div class="col-md-4 p-4">
                  <img
                  @if ($item->project_logo == null)
                  src ="{{ asset('assets/img/no-image.png') }}"
                  @else
                  src="{{ Storage::url($item->project_logo)}}"
                  @endif
                  class="card-img"
                  style="max-height: 165px; object-fit: cover;"
                  alt="..."
                  />
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <h5 class="card-title mb-0">
                          {{ $item->project_name }}
                        </h5>
                        <p class="card-text text-muted mb-0">
                          <small>Project Description</small>
                        </p>
                        <p
                        class="card-text text-black"
                        style="line-height: 18px;"
                        >
                        {{ $item->description }}
                      </p>
                      <p
                      class="card-text text-black-50"
                      style="font-size: 14px;"
                      >
                      <i class="fa fa-clock"></i> Due Date : 
                      {{ Carbon\Carbon::create($item->end)->format('d  F  Y') }}
                    </p>
                    <span class="badge badge-pill 
                    @if($item->project_status == 'Pending')
                    badge-light
                    @elseif($item->project_status == 'In Progress')
                    badge-secondary
                    @elseif($item->project_status == 'Completed')
                    badge-success
                    @endif
                    "
                    >{{ $item->project_status }}</span
                    >
                  </div>
                  <div class="col-3 text-right">
                    <div class="dropdown dropleft">
                      <button
                      class="btn btn-transparent"
                      type="button"
                      id="dropdownMenuButton2"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                      >
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu">
                      @if (Auth::id() == $item->project_manager)
                      <a
                      href="#modalMember"
                      data-remote="{{ route('my-project.show', $item->id) }}"
                      class="dropdown-item has-icon"
                      data-toggle="modal"
                      data-target="#modalMember"
                      data-title="Add Team Member"
                      ><i class="fas fa-user-plus"></i> Add Team
                      Member</a>
                      
                      <a class="dropdown-item has-icon" href="{{ route('my-project.edit', $item->id) }}"
                        ><i class="fas fa-pencil-alt"></i> Edit</a
                        >
                        @endif
                        
                        <a class="dropdown-item has-icon" href="#"
                        ><i class="fas fa-folder"></i> Project File</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
          class="row no-gutters rounded-bottom pl-4 pt-3"
          style="background-color: #8eb8c9;"
          >
          <div class="col-12 col-lg-3 col-md-3">
            <p class="text-white">
              Project Manager
              <span class="ml-1"
              ><img
              src="https://ui-avatars.com/api/?name={{ $item->user->name }}"
              data-toggle="tooltip"
              data-original-title="{{ $item->user->name }}"
              class="rounded-circle"
              height="30"
              alt=""
              /></span>
            </p>
          </div>
          <div class="col-12 col-lg-5 col-md-5">
            <p class="text-white">
              <span class="mr-3">Project Member</span>
              @foreach ($item->project_member->take(5) as $member)
              <span style="margin-left: -9px;"
              ><img 
              src="https://ui-avatars.com/api/?name={{ $member->user->name }}"
              data-toggle="tooltip"
              data-original-title="{{ $member->user->name }}"
              class="rounded-circle border"
              
              height="30"
              alt=""
              /></span>
              @endforeach
              
              @if($item->project_member->count() > 0)
              <a href="" 
              href="#modalMember"
              data-remote="{{ route('my-project.show', $item->id) }}"
              data-toggle="modal"
              data-target="#modalMember"
              data-title="{{ Auth::id() == $item->id ? "Add Team Member" : "Team Member"}}"
              data-original-title="View Member"
              style="
              margin-left: -9px;
              border-radius: 100px;
              
              background-color: #fff;
              padding: 5px 7px 6px 3px;
              "
              >
              <i class="fas fa-users"></i>
            </a>
            @endif
            
          </p>
        </div>
        <div
        class="col-12 col-lg-4 col-md-4 text-md-right mb-3"
        >
        <button class="btn btn-primary">Board</button>
        <button class="btn btn-warning mr-3 ml-2">
          Roadmap
        </button>
      </div>
    </div>
  </div>
</div>
</div>
@endforeach
</div>
</div>

</section>

</div>


@endsection


@push('addon-style')
<link rel="stylesheet" href="{{ asset('assets/bundles/select2/dist/css/select2.min.css') }}">
@endpush

@push('addon-script')
<script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>

@endpush