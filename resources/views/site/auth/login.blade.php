@extends('site.auth.layout')

@section('head-title', __('platform.Login'))

@section('space-top', 3)

@section('main')

<form method="POST" action="{{ route('login') }}">
    @csrf

    <img class="mb-3 img-fluid w-50" src="{{ asset('assets/img/brand/svg/logo-512.svg') }}" alt="">
    <h4 class="h4 mb-3 fw-bold text-dark">{{ __('platform.Sign in to your account') }}</h4>

    <div class="form-group">
        <input name="email" type="email" class="form-control" id="email" placeholder="{{ __('platform.Email address') }}" value="{{ old('email') }}"
            required>
    </div>
    <div class="form-group">
        <input name="password" type="password" class="form-control" id="password" placeholder="{{ __('platform.Password') }}" required>
    </div>

    <div class="checkbox my-1 py-1 form-check">
        <label for="remeber">
            <span class="text-light">{{ __('platform.Remember Me') }}</span>
            <input name="remeber" class="form-check-input vio-form-check-input" type="checkbox" value="remember-me"
                id="remeber">
        </label>
    </div>

    <button class="w-100 btn vio-btn-primary" type="submit">{{ __('platform.Sign in') }}</button>
    <p class="mt-3 text-black">{{ SiteOptions::get('site_title') }} &copy; {{ date('Y') }}</p>
</form>

@endsection
