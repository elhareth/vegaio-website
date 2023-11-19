@extends('site.auth.layout')

@section('head-title', 'Auth')

@section('space-top', 4)

@section('main')

<form method="POST" action="{{ route('password.confirm') }}" class="pt-2">
    @csrf

    <h1 class="bi bi-shield-lock-fill" style="color:var(--vio-color-primary);font-size:100px"></h1>

    <div class="mb-2 fw-bold lead text-dark">Please enter your password</div>

    <div class="form-group">
        <input name="password" type="password" class="form-control p-2" id="password" placeholder="Password" required>
    </div>

    <button class="w-100 btn btn-lg vio-btn-primary" type="submit">Confirm</button>
    <p class="mt-3 text-black">{{ SiteOptions::get('site_title') }} &copy; {{ date('Y') }}</p>
</form>

@endsection
