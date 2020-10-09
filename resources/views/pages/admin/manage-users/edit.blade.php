@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <h3 class="text-dark mb-2">Edit {{ $item->name }}</h3>
                <p class="text-muted" style="font-size: 16px;">Edit this user</p>
            </div>
            
        </div>
        
        <div class="card">
            <form action="{{ route('manage-users.update',$item->id) }}" class="needs-validation" novalidate="" method="post">
                @method('PUT')
                @csrf
                <div class="card-header">
                    <h4>Edit form</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{ $item->name }}" type="text" class="form-control @error('name') is-invalid @enderror" required="">
                        <div class="invalid-feedback">
                            Name is invalid
                        </div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                  
                    <div class="form-group">
                        <label>Roles</label>
                        <select name="roles" required class="form-control @error('roles') is-invalid @enderror">
                            <option value="{{ $item->roles }}" selected>Current roles as {{ $item->roles }}</option>
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
                   
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        
    </section>
</div>


@endsection
