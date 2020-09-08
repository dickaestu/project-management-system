@extends('layouts.auth')
@section('title','Forgot Password')

@section('content')
<section class="section" style="margin-top: 150px;">
    <div class="container">
        
        <div class="row">   
            <div class="col-lg-5">
                <h2 class="text-dark mb-0">Forgot Password</h2>
                <p class="text-muted" style="font-size: 16px;">Please input your email</p>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div class="form-group">
                        
                        <input id="email" placeholder="Email Address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                    <a href="{{ route('login') }}" class="btn btn-link text-dark" style="text-decoration: none">Back to login</a>
                    
                </form>
            </div>
            <div class="col-lg-6 offset-1 d-none d-lg-block">
                <img src="{{ asset('assets/img/img_login.png') }}" alt="img-login" class="w-100" style="height: 400px; margin-top: -50px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>
@endsection
