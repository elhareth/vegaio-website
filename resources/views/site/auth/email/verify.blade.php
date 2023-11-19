@extends('site.auth.layout')

@section('head-title', 'Email')

@section('space-top', 3)

@section('main')

<form method="POST" action="{{ route('verification.send') }}" class="pt-2">
    @csrf

    <h1 class="bi bi-send-arrow-up" style="color:var(--vio-color-primary);font-size:100px"></h1>

    <div class="mb-2 lead text-dark fw-bold">Verify your email address</div>

    <div class="form-group">
    </div>

    <button class="w-100 btn btn-lg vio-btn-primary" type="submit">Send Link</button>
    <p class="mt-3 text-black">{{ SiteOptions::get('site_title') }} &copy; {{ date('Y') }}</p>
</form>

@endsection
