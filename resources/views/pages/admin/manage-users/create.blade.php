@extends('layouts.admin')
@section('title', 'Create User')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <h3 class="text-dark mb-2">Create User</h3>
                <p class="text-muted" style="font-size: 16px;">Create account for member, administrator, and leader</p>
            </div>
            
        </div>
        
        <div class="card">
            <form action="{{ route('manage-users.store') }}" class="needs-validation" novalidate="" method="post">
                @csrf
                <div class="card-header">
                    <h4>Please fill this form</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" required="">
                        <div class="invalid-feedback">
                            Name is invalid
                        </div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required="">
                        <div class="invalid-feedback">
                            Email is invalid.
                        </div>
                         @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Roles</label>
                        <select name="roles" required class="form-control @error('roles') is-invalid @enderror">
                            <option value="">Choose roles</option>
                            <option value="MEMBER">Member</option>
                            <option value="ADMIN">Administrator</option>
                            <option value="LEADER">Leader</option>
                        </select>
                        <div class="invalid-feedback">
                            Roles is invalid!
                        </div>
                        @error('roles')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password"  name="password" required class="form-control @error('password') is-invalid @enderror">
                        <div class="invalid-feedback">
                            Password is invalid
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirmation Password</label>
                        <input type="password" name="password_confirmation" required="" class="form-control">
                        <div class="invalid-feedback">
                            Password confirmation is invalid
                        </div>
                    </div>
                   
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        
    </section>
</div>


@endsection
