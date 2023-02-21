@extends('auth._layout')

@section('title', 'Register')

@section('section-title', 'Register')

@section('content')
    <form class="user" method="post" action="{{ route('auth.doRegister') }}">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control form-control-user @error('fullname') is-invalid @enderror" id="fullname" name="fullname" placeholder="Full Name" value="{{ old('fullname') }}">
            @error('fullname')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password"
                id="password" placeholder="Password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Register
        </button>
    </form>
    <hr>
    <div class="text-center">
        <p class="small">Already have an account? <a href="{{ route('auth.login') }}">Login!</a></p>
    </div>
@endsection