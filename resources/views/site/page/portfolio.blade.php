@extends('site.layouts.basic')

@section('head-title', $portfolio->label)

@section('main')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

        <h2>{{ $portfolio->name }}</h2>

    </div>
</section>
<!-- End Breadcrumbs -->

<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <div class="swiper-slide">
                            <img src="/assets/themes/VegaIO/img/portfolio/portfolio-details-1.jpg" alt="">
                        </div>

                        <div class="swiper-slide">
                            <img src="/assets/themes/VegaIO/img/portfolio/portfolio-details-2.jpg" alt="">
                        </div>

                        <div class="swiper-slide">
                            <img src="/assets/themes/VegaIO/img/portfolio/portfolio-details-3.jpg" alt="">
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info">
                    <h3>Project Information</h3>
                    <ul>
                        <li><strong>Category</strong>: {{ $portfolio->category->getTitle() }}</li>
                        <li><strong>Client</strong>: {{ $portfolio->getClientTitle() }}</li>
                        <li><strong>Project Date</strong>: {{ $portfolio->getProjectDate() }}</li>
                        <li><strong>Project URL</strong>: {{ $portfolio->getProjectURL() }}</li>
                    </ul>
                </div>
                <div class="portfolio-description">
                    <h2>{{ $portfolio->getTitle() }}</h2>
                    <p>
                        {{ $portfolio->getDescription() }}
                    </p>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Portfolio Details Section -->
@endsection
