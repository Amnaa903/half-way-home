@extends('design.layouts.app')

@section('title', 'Confirm Password')

@section('content')
<p class="text-muted text-center mb-4">
    {{ __('Please confirm your password before continuing.') }}
</p>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="mb-4">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input id="password" type="password" 
               class="form-control @error('password') is-invalid @enderror" 
               name="password" required autocomplete="current-password"
               placeholder="Enter your password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            {{ __('Confirm Password') }}
        </button>
    </div>

    @if (Route::has('password.request'))
        <div class="text-center mt-3">
            <a href="{{ route('password.request') }}" class="text-decoration-none">
                {{ __('Forgot Your Password?') }}
            </a>
        </div>
    @endif
</form>
@endsection