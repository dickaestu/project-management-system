@extends('layouts.admin')
@section('title', 'Project Files')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3 class="text-dark mb-3">Project File ({{ $project->project_name }})</h3>
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
                  Project File 
                </li>
              </ol>
            </nav>
          </div>
        </div>
      
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <ul class="list-group">
                  @forelse ($items as $item)
                  <li class="list-group-item d-md-flex  justify-content-between align-items-center">
                    {{ $item->file_name }}
                    <span class="d-block">
                      <a href="{{ route('project-file-download-admin', $item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a>
                      
                    </span>
                  </li>
                  @empty
                  <li class="list-group-item text-center">
                    <img src="{{ asset('assets/img/no-project-file.svg') }}" height="250" class="mb-3">
                    <h5 class="mb-0 mt-3">Project File Is Empty</h5>
                    <p class="text-secondary">Please Click "Add File" To Upload Project File</p>
                  </li>
                  
                  
                  
                  @endforelse
                </ul>
              </div>
            </div>
          </div>
        </div>
        
        
        
      </div>
    </div>
  </section>
  
</div>






@endsection

