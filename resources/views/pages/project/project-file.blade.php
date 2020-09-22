@extends('layouts.main')
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
                  <a href="{{ route('my-project.index') }}">My Project</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Project File 
                </li>
              </ol>
            </nav>
          </div>
        </div>
        @error('file_name')
          <div class="row mb-3">
            <div class="col">
              <div class="text-danger">{{ $message }}</div>
            </div>
          </div>
        @enderror
        <div class="row mb-3 row-add-file">
          <div class="col-12"><button class="btn btn-success btn-sm add-file">Add File</button></div>
        </div>
        <div class="row mb-3 row-close-file">
          <div class="col-12"><button class="btn btn-danger btn-sm close-button">Close</button></div>
        </div>
        <div class="row form-add-file mb-3">
          <div class="col-12">
            
            <form action="{{ route('project-file-upload', $project->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="">Add File</label>
                <input type="file" name="file_name[]" class="form-control" id="filer_input2" multiple="multiple" />
              </div>
              <button type="submit" class="btn btn-success btn-block">ADD FILE</button>
            </form>
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
                      <a href="{{ route('project-file-download', $item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a>
                      <form class="d-inline" action="{{ route('project-file-delete', $item->id) }}" method="post">
                        @method('Delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                      </form>
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


@push('addon-style')

<link type="text/css" rel="stylesheet" href="{{ asset('assets/jquery-filler/css/jquery.filer.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('assets/jquery-filler/css/themes/jquery.filer-dragdropbox-theme.css') }}">

@endpush

@push('addon-script')
<script src="{{ asset('assets/jquery-filler/js/jquery.filer.min.js') }}"></script>
<script src="{{ asset('assets/jquery-filler/js/dragdrop.js') }}"></script>
<script>
  $('document').ready(function(){
    $('.form-add-file').hide();
    $('.row-close-file').hide();
    
    $('.add-file').click(function(){
      $('.form-add-file').show();
      $('.row-close-file').show();
      $('.row-add-file').hide();
    })
    
    $('.close-button').click(function(){
      $('.form-add-file').hide();
      $('.row-close-file').hide();
      $('.row-add-file').show();
    })
    
  });
</script>

@endpush