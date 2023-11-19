@extends('site.layouts.basic')

@section('main')
@section('blog-breadcrumbs')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">
        <h2>@yield('blog-breadcrumbs-title', __('blog.Blog'))</h2>
    </div>
</section>
<!-- End Breadcrumbs -->
@show

<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-8 entries">

                @yield('content')

            </div>
            <!-- End blog entries list -->

            <div class="col-lg-4">

                @include('site.blog.inc.sidebar')

            </div>
            <!-- End blog sidebar -->

        </div>

    </div>
</section>
<!-- End Blog Section -->
@endsection
