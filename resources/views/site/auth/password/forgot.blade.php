@extends('site.auth.layout')

@section('head-title', 'Auth')

@section('space-top', 3)

@section('main')

<form method="POST" action="{{ route('password.email') }}" class="pt-2">
    @csrf

    {{-- <img class="mb-3 img-fluid w-50" src="{{ asset('assets/img/brand/svg/logo-512.svg') }}" alt=""> --}}
    <h1 class="bi bi-shield-lock" style="color:var(--vio-color-primary);font-size:100px"></h1>

    <div class="mb-2 lead text-dark fw-bold">Enter your email address</div>

    <div class="form-group">
        <input name="email" type="email" class="form-control p-2" id="email" placeholder="Enter your email address"
            required>
    </div>

    <button class="w-100 btn btn-lg vio-btn-primary" type="submit">Submit</button>
    <p class="mt-3 text-black">{{ SiteOptions::get('site_title') }} &copy; {{ date('Y') }}</p>
</form>

@endsection
