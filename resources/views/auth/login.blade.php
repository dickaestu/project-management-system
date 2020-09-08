@extends('layouts.auth')
@section('title','Login')
@section('content')
<section class="section" style="margin-top: 150px;">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-5">
                <h2 class="text-dark mb-0">Project Management System</h2>
                <p class="text-muted" style="font-size: 16px;">Welcome back, please login to your account</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group form-check">
                                <input class="form-check-input " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="col text-right">
                            @if (Route::has('password.request'))
                                    <a class="" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-login">Login</button>
                </form>
            </div>
            <div class="col-lg-6 offset-1 d-none d-lg-block">
                <img src="{{ asset('assets/img/img_login.png') }}" alt="img-login" class="w-100" style="margin-top: -30px; height: 400px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>
@endsection
