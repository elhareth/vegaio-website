<!-- ======= Portfolio/Services Section ======= -->
<section id="services" class="portfolio">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>{{ Arr::get($ServicesSection, 'label') }}</h2>
            <p>{{ Arr::get($ServicesSection, 'description') }}</p>
        </div>

        <!--
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-card">Card</li>
                        <li data-filter=".filter-web">Web</li>
                    </ul>
                </div>
            </div>
            -->

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            @foreach (ServicesRepository::getRecords()->take(9) as $service)

            <div class="col-lg-4 col-md-6 portfolio-item filter-XXX">
                <div class="portfolio-wrap">
                    <img src="{{ $service->firstMedia('thumbnail')?->getUrl() ?? url('static/services/'.$service->slug.'.jpg') }}"
                        class="img-fluid" alt="{{ $service->name }}">
                    <div class="portfolio-info">
                        <h4>{{ $service->getTitle() }}</h4>
                        <p class="lead text-bg-vio-primary p-1">{{ $service->name }}</p>
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
