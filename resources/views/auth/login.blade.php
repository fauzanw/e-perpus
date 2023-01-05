@extends('auth.layout')

@section('title', 'Login')

@section('section-title', 'Auth Login')

@section('content')
    <form class="user" method="post" action="{{ route('auth.doLogin') }}">
        @csrf
        @include('_notification')
        <div class="form-group">
            <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
            @error('username')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password"
                id="password" placeholder="Password">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" id="customCheck">
                <label class="custom-control-label" for="customCheck">Remember
                    Me</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Login
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('auth.register') }}">Create an Account!</a>
    </div>
@endsection