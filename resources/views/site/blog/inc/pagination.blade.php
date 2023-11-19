@if ($paginator->hasPages())
<div class="blog-pagination">
    <ul class="justify-content-center d-sm-none">
        @if ($paginator->onFirstPage())
        <li class="disabled active" aria-disabled="true">
            <a class="page-link">@lang('pagination.previous')</a>
        </li>
        @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
        </li>
        @endif

        <li><span class="page-number">{{ $paginator->currentPage() }}</span></li>

        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
        </li>
        @else
        <li class="disabled active" aria-disabled="true">
            <a class="page-link">@lang('pagination.next')</a>
        </li>
        @endif
    </ul>

    <ul class="justify-content-center d-none d-sm-flex">
        @if ($paginator->onFirstPage())
        <li class="disabled active" aria-disabled="true">
            <a class="page-link">@lang('pagination.previous')</a>
        </li>
        @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
        </li>
        @else
        <li class="disabled active" aria-disabled="true">
            <a class="page-link">@lang('pagination.next')</a>
        </li>
        @endif
    </ul>
</div>
@endif
