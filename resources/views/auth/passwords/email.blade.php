@extends('design.layouts.app')

@section('title', 'Reset Password')

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-4">
        <label for="email" class="form-label">{{ __('Email Address') }}</label>
        <input id="email" type="email" 
               class="form-control @error('email') is-invalid @enderror" 
               name="email" value="{{ old('email') }}" 
               required autocomplete="email" autofocus
               placeholder="Enter your email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fa fa-paper-plane me-2"></i>{{ __('Send Password Reset Link') }}
        </button>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}" class="text-decoration-none">
            <i class="fa fa-arrow-left me-1"></i>Back to Login
        </a>
    </div>
</form>
@endsection