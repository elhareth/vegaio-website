    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header @yield('alt-header-class', null)">
        <div class="container d-flex align-items-center">
            {{-- <h1 class="logo me-auto"><a href="{{ route('index') }}">Vega<span>IO</span></a></h1> --}}
            <a href="{{ route('index') }}" class="logo me-auto" id="logo-link"><img id="logo" src="@yield('logo-img-path', '/assets/img/brand/logo-land.png')" alt=""></a>
            <a href="{{ route('index') }}" class="logo me-auto d-none" id="logo-link-alt"><img id="logo" src="@yield('logo-img-path', '/assets/img/brand/logo-land-white.png')" alt=""></a>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto" href="{{ auth()->check() ? route('home') : '/#hero' }}">{{ __('nav.pages.Home') }}</a></li>
                    <li><a class="nav-link {{ active_class_route('blog.index') }}" href="{{ route('blog.index') }}">{{ __('nav.pages.Blog') }}</a></li>
                    <li><a class="nav-link scrollto" href="/#about">{{ __('nav.pages.About us') }}</a></li>
                    <li><a class="nav-link scrollto" href="/#services">{{ __('nav.pages.Services') }}</a></li>
                    <li><a class="nav-link scrollto" href="/#contact">{{ __('nav.pages.Contact') }}</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            {{-- <a href="{{ route('login') }}" class="btn btn-info ms-3">Login</a>
            <a href="{{ route('register') }}" class="btn btn-dark ms-3">Register</a> --}}
        </div>
    </header>
    <!-- End Header -->
