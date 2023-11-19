<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta content="{{ csrf_token() }}" name="csrf-token">

    <title>{{ SiteOptions::get('site_title') }} | @yield('head-title', 'Authentication')</title>
    <meta name="description" content="@yield('head-description', SiteOptions::get('site_description'))">
    <meta name="keywords" content="@yield('head-keywords', implode(', ', SiteOptions::get('site_keywords', collect([]))->toArray()))">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/brand/apple-touch-icon.png') }}">
    <meta name="theme-color" content="#660033" />

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontiaOne.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/css/vegaio.'. (app()->getLocale() == 'ar' ? 'rtl' : 'ltr') .'.min.css') }}">

    @stack('headstack')
</head>

<body class="auth-form-body text-center {{ $_body_class ?? null }}">

    <div class="my-sm-@yield('space-top', 1) py-sm-@yield('space-top', 1)"></div>

    @if ($errors->any())
    @foreach ($errors->all() as $error)

    <div class="col-11 col-sm-7 col-md-5 col-lg-3 error-toast-line">
        {{ $error }}
    </div>
    @endforeach
    @endif

    <main class="auth-form-signin col-11 col-sm-7 col-md-5 col-lg-3 mx-auto">
        @yield('main')
    </main>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/axios/axios.min.js') }}"></script>
    <script>
        const BearerToken =  "{{ request()->cookie('BearerToken', false) ? 'Bearer '. request()->cookie('BearerToken') : '********' }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                beforeSend: function (xhr) {
                    if (BearerToken) {
                        xhr.setHeader('Authorization', 'Bearer ' + BearerToken);
                    }
                }
            });

            window.axiosInstance = axios;
            window.axiosInstance.defaults.withCredentials = true;
            window.axiosInstance.defaults.headers.common['Accept'] = 'application/json';
            window.axiosInstance.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
            window.axiosInstance.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

            function remove_dom_element(selector) {
                $(selector).remove();
                // console.log(selector);
            }
    </script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/vegaio.main.js') }}"></script>

    @stack('footstack')

</body>

</html>
