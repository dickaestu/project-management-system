@extends('layouts.main')
@section('title', 'Create Project')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3 class="text-dark mb-3">Create Project</h3>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card" id="sample-login">
              <form method="POST" action="{{ route('my-project.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                  <h4>Project Details</h4>
                </div>
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="">Logo Project</label>
                        <input type="file" name="project_logo" class="form-control " id="">
                        @error('project_logo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="">Max: 7mb, img / png / jpeg</small>
                      </div>
                      
                      <div class="form-group">
                        <label for="">Project Name</label>
                        <input type="text" name="project_name" class="form-control @error('project_name') is-invalid @enderror" value="{{ old('project_name') }}">
                        @error('project_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      
                      <div class="form-group">
                        <label for="">Client Name</label>
                        <input type="text" name="client_name" class="form-control @error('client_name') is-invalid @enderror" value="{{ old('client_name') }}">
                        @error('client_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      
                      
                      <div class="form-group">
                        <label>Project Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      
                    </div>
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Project Start</label>
                        <input name="start" type="date" class="form-control @error('start') is-invalid @enderror" value="{{ old('start') }}">
                        @error('start')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      
                      <div class="form-group">
                        <label>Project Deadline</label>
                        <input name="end" type="date" class="form-control  @error('end') is-invalid @enderror" value="{{ old('end') }}">
                        @error('end')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      
                      <div class="form-group">
                        <label for="">Add File</label>
                        <input type="file" name="file_name[]" class="form-control" id="filer_input2" multiple="multiple" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Create Project</button>
                </div>
              </form>
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
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/gijgo.min.css') }}">


@endpush

@push('addon-script')
<script src="{{ asset('assets/jquery-filler/js/jquery.filer.min.js') }}"></script>
<script src="{{ asset('assets/jquery-filler/js/dragdrop.js') }}"></script>
<script src="{{ asset('assets/js/gijgo.min.js') }}"></script>
<script>
  $(document).ready(function(){
    $('.datepicker').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      showRightIcon: false,
      format: 'yyyy-mm-dd'
    });
    $('.datepicker2').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      showRightIcon: false,
      format: 'yyyy-mm-dd'
    });
  })
</script>

@endpush
