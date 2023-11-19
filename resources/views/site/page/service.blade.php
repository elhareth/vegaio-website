@extends('site.layouts.basic')

@section('head-title', $service->label)

@section('main')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

        <h2>{{ $service->label }}</h2>

    </div>
</section>
<!-- End Breadcrumbs -->

<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-8 h-100">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        @foreach ($service->getMedia('slider') as $photo)

                        <div class="swiper-slide">
                            <img src="{{ $photo->getUrl() }}" alt="{{ $service->name }}">
                        </div>
                        @endforeach

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info">
                    <h3>@lang('services.Service Information')</h3>
                    <p>
                        {!! Purifier::clean($service->getDescription()) !!}
                    </p>
                    {{-- <ul class="border-top mt-2 pt-2">
                        <li><strong>@lang('models/category.label.Model')</strong>: {{ $service->category->getTitle() }}</li>
                        <li><strong>@lang('services.Projects')</strong>: {{ $service->getProjects()->count() }}</li>
                    </ul> --}}
                </div>
                {{-- <div class="portfolio-description">
                    <h2>{{ $service->getTitle() }}</h2>
                    <p>
                        {!! Purifier::clean($service->getDescription()) !!}
                    </p>
                </div> --}}
            </div>

        </div>

    </div>
</section>
<!-- End Portfolio Details Section -->
@endsection
