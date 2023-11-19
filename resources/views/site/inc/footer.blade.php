    <!-- ======= Footer ======= -->
    <footer id="footer">
        {{--
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6 footer-contact">
                        <h3>Vega <span style="color:var(--color-primary-light)">I/O</span></h3>
                        <p>
                            {{ SiteOptions::getLocationInfo('khartoum-1.city') }}<br>
                            {{ SiteOptions::getLocationInfo('khartoum-1.street') }}<br>
                            {{ SiteOptions::getLocationInfo('khartoum-1.country') }}<br><br>
                            <span dir="ltr"><strong>Phone: </strong>{{ SiteOptions::getPrimaryEmail() }}</span><br>
                            <span dir="ltr"><strong>Email: </strong>{{ SiteOptions::getPrimaryPhone() }}</span><br>
                        </p>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i> <a href="{{ auth()->check() ? route('home') : route('index') }}">{{ __('nav.pages.Home') }}</a></li>
                            <li><i class="bx bx-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i> <a href="{{ route('services') }}">{{ __('nav.pages.Services') }}</a></li>
                            <li><i class="bx bx-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i> <a href="{{ route('tos') }}">{{ __('nav.pages.Terms of service') }}</a></li>
                            <li><i class="bx bx-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i> <a href="{{ route('policy') }}">{{ __('nav.pages.Privacy policy') }}</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            @foreach (ServicesRepository::getRecords()->random(4) as $service)

                            <li><i class="bx {{ app()->getLocale() == 'ar' ? 'bx-chevron-left' : 'bx-chevron-right' }}"></i> <a href="{{ route('service', $service->slug) }}">{{ $service->label }}</a></li>
                            @endforeach

                        </ul>
                    </div>

                </div>
            </div>
        </div>
        --}}

        <div class="" style="background: var(--vio-color-secondary-dark)">
            <div class="container d-md-flex py-2">
                <div class="me-md-auto text-center text-md-start">
                    <div class="copyright pt-2">
                        {{ date('Y') }} &copy; <strong>Vega <span style="">I/O</span></strong>
                    </div>
                </div>
                <div class="social-links text-center text-md-end pt-3 pt-md-0">
                    <a href="{{ SiteOptions::getSocialLink('twitter') }}" class="twitter">
                        <i class="bx bxl-twitter"></i>
                    </a>
                    <a href="{{ SiteOptions::getSocialLink('facebook') }}" class="facebook">
                        <i class="bx bxl-facebook"></i>
                    </a>
                    <a href="{{ SiteOptions::getSocialLink('whatsapp') }}" class="whatsapp">
                        <i class="bx bxl-whatsapp"></i>
                    </a>
                    <a href="{{ SiteOptions::getSocialLink('instagram') }}" class="instagram">
                        <i class="bx bxl-instagram"></i>
                    </a>
                    <a href="{{ SiteOptions::getSocialLink('linkedin') }}" class="linkedin">
                        <i class="bx bxl-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>
