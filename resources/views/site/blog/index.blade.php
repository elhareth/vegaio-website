@extends('site.blog.layout')

@section('head-title', __('blog.Blog'))

@section('content')

@if ($articles->count() == 0)
    <div class="entry text-center">
        <p class="lead">@lang('blog.No articles yet')</p>
    </div>
@endif

@foreach ($articles as $article)
<article class="entry">
    @if ($article->hasMedia('thumbnail'))

    <div class="entry-img">
        <img src="{{ $article->firstMedia('thumbnail')->getUrl() }}" alt="" class="img-fluid">
    </div>
    @endif

    <h2 class="entry-title">
        <a href="{{ route('blog.article', $article) }}">{{ $article->title }}</a>
    </h2>

    <div class="entry-meta">
        <ul>
            <li class="d-flex align-items-center">
                <i class="bi bi-person"></i>
                <a href="{{ route('blog.author', $article->author) }}">{{ $article->author ? $article->author->username : '' }}</a>
            </li>
            <li class="d-flex align-items-center">
                <i class="bi bi-clock"></i>
                <a><time datetime="{{ $article->published_at->format('Y-m-d') }}">{{ $article->published_at->format('M d, Y') }}</time></a>
            </li>
            <li class="d-flex align-items-center">
                <i class="bi bi-chat-dots"></i>
                <a>{{ trans_choice('blog.comments_count', $article->comments_count) }}</a>
            </li>
        </ul>
    </div>

    <div class="entry-content">
        <p>
            {{ strip_tags($article->excerpt ?: Str::limit($article->content, 500)) }}
        </p>
        <div class="read-more">
            <a href="{{ route('blog.article', $article) }}">@lang('platform.buttons.read_more')</a>
        </div>
    </div>

</article><!-- End blog entry -->
@endforeach

{{ $articles->onEachSide(1) ->links('site.blog.inc.pagination') }}
@endsection
