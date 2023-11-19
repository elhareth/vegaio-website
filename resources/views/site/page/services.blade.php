@extends('site.layouts.basic')

@section('head-title', __('services.title'))

@section('main')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">
        <h2>{{ __('services.title') }}</h2>
    </div>
</section>
<!-- End Breadcrumbs -->

<section class="mt-0">
    @foreach (ServicesRepository::getRecords() as $service)

    <div class="container col-xxl-8 px-4 py-3">
        <div class="row flex-lg-row-reverse align-items-center py-3 rounded-3 border shadow-lg">
            <div class="col-10 col-sm-8 col-lg-6 mx-auto">
                <img src="{{ $service->firstMedia('thumbnail')?->getUrl() }}" class="d-block mx-lg-auto img-fluid img-thumbnail" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">{{ $service->label }}</h1>
                <p class="lead">{!! Purifier::clean($service->description) !!}</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a type="button" class="btn btn-outline-vio-secondary px-4" href="{{ route('service', $service) }}">@lang('platform.buttons.see_details')</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</section>
@endsection
