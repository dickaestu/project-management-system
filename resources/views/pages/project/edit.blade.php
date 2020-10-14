@extends('layouts.main')
@section('title', 'Edit Project')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3 class="text-dark mb-3">Edit Project</h3>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card" id="sample-login">
              <form method="POST" action="{{ route('my-project.update', $item->id) }}" enctype="multipart/form-data">
                @method('PUT')
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
                        <input type="text" name="project_name" class="form-control @error('project_name') is-invalid @enderror" value="{{ $item->project_name }}">
                        @error('project_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      
                      <div class="form-group">
                        <label for="">Client Name</label>
                        <input type="text" name="client_name" class="form-control @error('client_name') is-invalid @enderror" value="{{ $item->client_name }}">
                        @error('client_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      
                      
                      <div class="form-group">
                        <label>Project Description</label>
                        <textarea name="description" style="height: 160px !important"  class="form-control @error('description') is-invalid @enderror">{{ $item->description }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      
                    </div>
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Project Start</label>
                        <input name="start" type="date" class="form-control @error('start') is-invalid @enderror" value="{{ $item->start }}">
                        @error('start')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      
                      <div class="form-group">
                        <label>Project Deadline</label>
                        <input name="end" type="date" class="form-control @error('end') is-invalid @enderror" value="{{ $item->end }}">
                        @error('end')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>

                         <div class="form-group">
                        <label>Change Project Status</label>
                        <select class="form-control" name="project_status">
                          <option value="{{ $item->project_status }}">Status Now ({{ $item->project_status }})</option>
                          <option value="Pending">Pending</option>
                          <option value="In Progress">In Progress</option>
                          <option value="Completed">Completed</option>
                          <option value="Abandoned">Abandoned</option>
                        </select>
                      </div>
                      
                      
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Edit Project</button>
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

