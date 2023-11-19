<div class="sidebar">
    @section('blog-sidebar')

    {{-- <h3 class="sidebar-title">Search</h3>
    <div class="sidebar-item search-form">
        <form action="">
            <input type="text" class="form-control">
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End sidebar search formn--> --}}

    <h3 class="sidebar-title">@lang('models/category.label.Models')</h3>
    <div class="sidebar-item categories">
        <ul>
            @foreach (CategoriesRepository::getBlogCategories(false) as $category)

            <li>
                <a href="{{ $category->slug }}">
                    {{ $category->title }} <span>({{ $category->articles_count }})</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <!-- End sidebar categories-->

    @show
</div>
<!-- End sidebar -->
