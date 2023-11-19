@extends('site.auth.layout')

@section('head-title', __('platform.Registration'))

@section('space-top', 0)

@section('main')

<form method="POST" action="{{ route('register') }}">
    @csrf

    <img class="mb-3 img-fluid w-50" src="{{ asset('assets/img/brand/svg/logo-512.svg') }}" alt="">
    <h4 class="h4 mb-3 fw-bold text-dark">{{ __('platform.Create new account') }}</h4>

    <div class="form-group">
        <input name="email" type="email" class="form-control" id="email" placeholder="{{ __('platform.Email address') }}" value="{{ old('email') }}"
            required>
    </div>
    <div class="form-group">
        <input name="username" type="text" class="form-control" id="username" placeholder="{{ __('platform.Username') }}" value="{{ old('username') }}" required>
    </div>
    <div class="form-group">
        <input name="password" type="password" class="form-control" id="password" placeholder="{{ __('platform.Password') }}" required>
    </div>
    <div class="form-group">
        <input name="password_confirmation" type="password" class="form-control" id="{{ __('platform.Confirm password') }}" placeholder="{{ __('platform.Confirm password') }}" required>
    </div>
    <div class="form-group">
        <input name="profile[first_name]" type="text" class="form-control" id="first_name" placeholder="{{ __('site/user.field.first_name.label') }}" value="{{ old('profile.first_name') }}">
    </div>
    <div class="form-group">
        <input name="profile[last_name]" type="text" class="form-control" id="last_name" placeholder="{{ __('site/user.field.last_name.label') }}" value="{{ old('profile.last_name') }}">
    </div>

    <button class="w-50 btn vio-btn-primary mt-4" type="submit">{{ __('platform.Sign up') }}</button>

    <p class="mt-3 text-black">{{ SiteOptions::get('site_title') }} &copy; {{ date('Y') }}</p>
</form>

@endsection
