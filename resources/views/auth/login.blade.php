@extends('auth.layouts.main')
@section('title', 'Auth Login')

@section('content')
<div id="auth-left">
<div class="auth-logo">
    <a href="index.html"><img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo"></a>
</div>
<h1 class="auth-title">Login.</h1>
<p class="text-muted mb-3">Sebelum bisa mengakses perpustakaan, kamu perlu masu k terlebih dahulu.</p>

<form method="post" action="{{ route('auth.doLogin') }}">
    @csrf
    <div class="form-group position-relative has-icon-left mb-2">
        <input type="text" class="form-control form-control-xl @error('username') is-invalid @enderror" placeholder="Username" name="username" id="username" value="{{ old('username') }}">
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
        @error('username')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group position-relative has-icon-left mb-2">
        <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password" name="password" id="password" value="{{ old('password') }}">
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        @error('password')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Login</button>
</form>
</div>
@endsection