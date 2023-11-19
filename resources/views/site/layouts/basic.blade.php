<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta content="{{ csrf_token() }}" name="csrf-token">

    <title>@yield('head-title', SiteOptions::get('site_title'))</title>
    <meta name="description" content="@yield('head-description', SiteOptions::get('site_description'))">
    <meta name="keywords"
        content="@yield('head-keywords', implode(', ', SiteOptions::get('site_keywords', collect([]))->toArray()))">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/brand/apple-touch-icon.png') }}">
    <meta name="theme-color" content="#660033" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('vendor/aos/aos.css') }}">
    {{--
    <link rel="stylesheet"
        href="/vendor/bootstrap/css/{{ app()->getLocale() == 'ar' ? 'bootstrap.rtl.min.css' : 'bootstrap.min.css' }}">
    --}}
    <link rel="stylesheet" href="/vendor/bootstrap-icons/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="/vendor/glightbox/css/glightbox.min.css">
    <link rel="stylesheet" href="/vendor/remixicon/remixicon.css">
    <link rel="stylesheet" href="/vendor/swiper/swiper-bundle.min.css">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="/assets/css/fontiaOne.css">
    <link rel="stylesheet" href="{{ '/assets/css/vegaio.'. (app()->getLocale() == 'ar' ? 'rtl' : 'ltr') .'.min.css' }}">

    @stack('headstack')
</head>

<body class="{{ $_body_class ?? null }}" data-bs-theme="light">

    @include('site.inc.header')

    @yield('hero', '')

    <main id="main">

        @yield('main')

    </main>
    <!-- End #main -->

    @include('site.inc.footer')

    <div id="preloader"></div>

    <!-- Setup JS Files -->
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

                window.axiosRequester = axios;
                window.axiosRequester.defaults.withCredentials = true;
                window.axiosRequester.defaults.headers.common['Accept'] = 'application/json';
                window.axiosRequester.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
                window.axiosRequester.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

                function remove_dom_element(selector) {
                    $(selector).remove();
                    // console.log(selector);
                }
    </script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/vegaio.main.js') }}"></script>

    <!-- Footstack -->
    @stack('footstack')

</body>

</html>
