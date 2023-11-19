@extends('site.auth.layout')

@section('head-title', 'Auth')

@section('space-top', 1)

@section('main')
<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <h1 class="bi bi-shield-lock-fill" style="color:var(--vio-color-primary);font-size:50px"></h1>

    <h1 class="h3 mb-2 fw-bold text-dark">Reset your password</h1>

    <div class="form-group">

    </div>
    <div class="form-group">

    </div>

    <button class="w-100 btn btn-lg vio-btn-primary" type="submit">Update</button>
    <p class="mt-3 text-black">{{ SiteOptions::get('site_title') }} &copy; {{ date('Y') }}</p>
</form>

@endsection
