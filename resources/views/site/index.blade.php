@extends('site.layouts.basic')

@section('head-title', 'Vega IO')

@section('alt-header-class', 'alt-header')

@section('hero')
@include('site.inc.sections.hero')
@endsection

@section('main')

<!-- ======= About Section ======= -->
<section id="about" class="about bg-vio-secondary text-bg-vio-secondary">
    <div class="container" data-aos="fade-up">

        <div class="row no-gutters">
            <div class="content col-xl-5 d-flex align-items-stretch">
                <div class="content">
                    <h3>{{ Arr::get($AboutSection, 'tagline') }}</h3>
                    <p>{{ Arr::get($AboutSection, 'description') }}</p>
                </div>
            </div>
            <div class="col-xl-7 d-flex align-items-stretch">
                <div class="icon-boxes d-flex flex-column justify-content-center">
                    <div class="row">
                        @foreach (Arr::get($AboutSection, 'tiles') as $Tile)
                        <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                            <i class="{{ $Tile['icon'] }}"></i>
                            <h4>{{ $Tile['title'] }}</h4>
                            <p>{{ $Tile['description'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- End .content-->
            </div>
        </div>

    </div>
</section>
<!-- End About Section -->


{{-- @include('site.inc.sections.tabs') --}}
{{-- @include('site.inc.sections.services') --}}

<!-- ======= Portfolio/Services Section ======= -->
<section id="services" class="portfolio">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>{{ Arr::get($ServicesSection, 'label') }}</h2>
            <p>{{ Arr::get($ServicesSection, 'description') }}</p>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            @foreach (ServicesRepository::getRecords()->take(9) as $service)

            <div class="col-lg-4 col-md-6 portfolio-item filter-XXX">
                <div class="portfolio-wrap">
                    <img src="{{ $service->firstMedia('thumbnail')?->getUrl() ?? url('static/services/'.$service->slug.'.jpg') }}"
                        class="img-fluid" alt="{{ $service->name }}">
                    <div class="portfolio-info">
                        {{-- <h4>{{ $service->getTitle() }}</h4> --}}
                        {{-- <p class="lead text-bg-vio-primary p-1">{{ $service->name }}</p> --}}
                        <div class="portfolio-links">
                            <a href="{{ $service->firstMedia('thumbnail')?->getUrl() ?? url('static/services/'.$service->slug.'.jpg') }}"
                                data-gallery="portfolioGallery" class="portfolio-lightbox"
                                title="{{ $service->getTitle() }}">
                                <i class="bx bx-plus"></i>
                            </a>
                            <a href="{{ route('service', $service->slug) }}"
                                title="{{ __('platform.buttons.more_details') }}">
                                <i class="bx bx-link"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section>
<!-- End Portfolio Section -->

{{-- @include('site.inc.sections.pricing') --}}

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>{{ Arr::get($ContactSection, 'label') }}</h2>
            <p>{{ Arr::get($ContactSection, 'description') }}</p>
        </div>

        <div class="row align-items-stretch" data-aos="fade-up" data-aos-delay="100">

            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="info-box">
                            <i class="bx bx-map"></i>
                            <h3>@lang('platform.Our Address')</h3>
                            <p>{{ SiteOptions::getAddress() }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box mt-4">
                            <i class="bx bx-envelope"></i>
                            <h3>@lang('platform.Email Us')</h3>
                            <p>
                                {{ SiteOptions::getPrimaryEmail() }}
                                <br>
                                {{ SiteOptions::getContactEmail() }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box mt-4">
                            <i class="bx bx-phone-call"></i>
                            <h3>@lang('platform.Call Us')</h3>
                            <p dir="ltr">
                                {{ SiteOptions::getPrimaryPhone() }}
                                <br>
                                {{ SiteOptions::getContactPhone() }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">
                <form action="{{ route('contact') }}" method="post" role="form" class="contact-us-form">
                    @csrf

                    @guest

                    <div class="row">
                        <div class="col form-group">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="@lang('platform.forms.Your name')" required>
                        </div>
                        <div class="col form-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="@lang('platform.forms.Your email')" required>
                        </div>
                    </div>
                    @else

                    <div class="row">
                        <div class="col form-group">
                            <input type="text" class="form-control" value="{{ auth()->user()->getDisplayName() }}"
                                disabled>
                        </div>
                        <div class="col form-group">
                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                        </div>
                    </div>
                    @endguest

                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" id="subject"
                            placeholder="@lang('platform.forms.Subject')" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5"
                            placeholder="@lang('platform.forms.Message')" required></textarea>
                    </div>
                    <div class="my-3">
                        <div class="loading">@lang('platform.Loading')</div>
                        <div class="error-message"></div>
                        <div class="sent-message"></div>
                    </div>
                    <div class="text-center"><button type="submit">{{ __('platform.buttons.send_message') }}</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</section>
<!-- End Contact Section -->
@endsection


@push('headstack')
<style>
    header#header.header-unscrolled {
        background: transparent;
    }

    header#header.header-unscrolled nav.navbar .nav-link {
        color: #fff;
    }

    header#header.header-unscrolled nav.navbar a:hover,
    header#header.header-unscrolled nav.navbar .active,
    header#header.header-unscrolled nav.navbar .active:focus,
    header#header.header-unscrolled nav.navbar li:hover>a {
        color: var(--vio-color-primary-light);
    }
</style>
@endpush

@push('footstack')

<script src="{{ asset('vendor/contact-from/contact-form.js') }}"></script>
@endpush
