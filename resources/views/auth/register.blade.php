@extends('auth.app')

@section('title', 'Register')

@section('content')
<form method="POST" action="{{ route('register') }}">
@csrf
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="text" class="form-control form-control-xl @error('email') is-invalid @enderror" email="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
        <div class="form-control-icon">
            <i class="bi bi-envelope"></i>
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="text" class="form-control form-control-xl @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Username">
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="password" class="form-control form-control-xl" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
</form>
<div class="text-center mt-5 text-lg fs-4">
    <p class='text-gray-600'>Already have an account? <a href="{{route('login')}}"
            class="font-bold">Log
            in</a>.</p>
</div>
@endsection

