@extends('layouts.main')
@section('title', 'Settings')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="container">
        <div class="row">
        
          <div class="col-12">
            <h3 class="text-dark mb-3">Settings</h3>
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
                  Settings
                </li>
              </ol>
            </nav>
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

         {{-- Content --}}
      <div class="container">
        <section class="section">
          <div class="section-body">
            <h2 class="section-title"></h2>
            <div class="row">
               <div class="col-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h4 class="text-white">Reset Password</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('change-password') }}">
                    @method('PUT')
                    @csrf
                  <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input
                      id="old_password"
                      type="password"
                      class="form-control @error('old_password') is-invalid @enderror"
                      name="old_password"
                      required
                    />
                    @error('old_password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @if (session('error'))
                    <small class="text-danger">{{ session('error') }}</small>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="password">New Password</label>
                    <input
                      id="password"
                      type="password"
                      class="form-control @error('password') is-invalid @enderror"
                      name="password" 
                    required
                    />
                     @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input
                      id="password_confirmation"
                      type="password"
                      class="form-control"
                      name="password_confirmation" 
                      required
                    />
                  </div>
                  <div class="form-group d-flex justify-content-center">
                    <button
                      type="submit"
                      class="btn btn-success btn-lg"
                    >
                      Reset Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
            </div>
            </div>
          </div>
        </section>
      </div>
      {{-- End of Content --}}
      
     
      
    </div>
  </div>
</section>

</div>


@endsection

