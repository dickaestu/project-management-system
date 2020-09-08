@extends('layouts.auth')
@section('title','Reset Password')
@section('content')
<section class="section" style="margin-top: 150px;">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-5">
                <h2 class="text-dark mb-0">Reset Password</h2>
                <p class="text-muted" style="font-size: 16px;">Reset your password</p>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        
                    </div>
                 
                    <button type="submit" class="btn btn-block btn-login">Reset Password</button>
                </form>
            </div>
            <div class="col-lg-6 offset-1 d-none d-lg-block">
                <img src="{{ asset('assets/img/img_login.png') }}" alt="img-login" class="w-100" style="margin-top: -30px; height: 400px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>
@endsection
