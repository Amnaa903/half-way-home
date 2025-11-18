@extends('design.layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="text-center">
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    <div class="mb-4">
        <i class="fa fa-envelope fa-3x text-primary mb-3"></i>
        <h4>{{ __('Verify Your Email Address') }}</h4>
    </div>

    <p class="text-muted mb-4">
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
    </p>

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary">
            {{ __('Click here to request another') }}
        </button>
    </form>

    <div class="mt-4">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-decoration-none">
            {{ __('Return to Login') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
@endsection