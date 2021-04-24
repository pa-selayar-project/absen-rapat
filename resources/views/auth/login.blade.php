@extends('auth.app')

@section('title', 'Login')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group position-relative has-icon-left mb-4">
        <input id="email" type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input id="password" type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
    <div class="form-check form-check-lg d-flex align-items-end">
        <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label text-gray-600" for="flexCheckDefault">
            Keep me logged in
        </label>
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
</form>

<div class="text-center mt-5 text-lg fs-4">
    <p class="text-gray-600">Don't have an account? 
    @if (Route::has('register'))
        <a class="font-bold" href="{{ route('register') }}">Register</a>
    @endif
    </p>
    <p>
    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif
    </p>
</div>
@endsection
