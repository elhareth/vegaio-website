@extends('site.blog.layout')

@section('head-title', $article->title)

@section('content')
<article class="entry entry-single">
    @if ($article->hasMedia('thumbnail'))

    <div class="entry-img">
        <img src="{{ $article->firstMedia('thumbnail')->getUrl() }}" alt="" class="img-fluid">
    </div>
    @endif

    <h2 class="entry-title">
        <a>{{ $article->title }}</a>
    </h2>

    <div class="entry-meta">
        <ul>
            <li class="d-flex align-items-center">
                <i class="bi bi-person"></i>
                <a href="{{ route('blog.author', $article->author) }}">{{ $article->author ? $article->author->username : '' }}</a>
            </li>
            <li class="d-flex align-items-center">
                <i class="bi bi-clock"></i>
                <a><time datetime="2020-01-01">{{ $article->published_at->format('M d, Y') }}</time></a>
            </li>
            <li>
                <i class="bi bi-chat-dots"></i>
                <a>{{ trans_choice('blog.comments_count', $article->comments_count) }}</a>
            </li>
        </ul>
    </div>

    <div class="entry-content">
        {!! $article->content !!}
    </div>

    <div class="entry-footer">
        <i class="bi bi-bookmark"></i>
        <ul class="cats">
            <li><a href="{{ route('blog.category', $article->category) }}">{{ $article->category ? $article->category->title : '' }}</a></li>
        </ul>
    </div>

</article><!-- End blog entry -->

<div class="blog-comments">

    <h4 class="comments-count">{{ trans_choice('blog.Comments_Count', $article->comments_count) }}</h4>

    @foreach ($article->comments as $comment)

    <div id="{{ $comment->id }}" class="comment">
        <div class="d-flex">
            <div class="comment-img"><img src="/assets/themes/VegaIO/img/blog/comments-{{ rand(1, 5) }}.jpg" alt=""></div>
            <div>
                <h5><a {!! $comment->user ? 'href="' . route('blog.author', $comment->user) .'"' : '' !!}>{{ $comment->getUserName() }}</a>
                </h5>
                <time datetime="{{ $comment->created_at->format('Y-m-d') }}">{{ $comment->created_at->diffForHumans() }}</time>
                <p>
                    {{ strip_tags($comment->comment) }}
                </p>
            </div>
        </div>
    </div><!-- End comment #1 -->
    @endforeach


    <div class="reply-form" id="comment-form">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <h4>@lang('blog.Leave a comment')</h4>
        <form action="{{ route('blog.article.comment', $article) }}#comment-form" method="POST">
            @csrf
            @guest

            <div class="row">
                <div class="col-md-6 form-group">
                    <input name="name" type="text" class="form-control" placeholder="@lang('platform.forms.Your name')">
                </div>
                <div class="col-md-6 form-group">
                    <input name="email" type="email" class="form-control" placeholder="@lang('platform.forms.Your email')">
                </div>
            </div>
            @endguest

            <div class="row">
                <div class="col form-group">
                    <textarea name="comment" class="form-control" placeholder="@lang('platform.forms.Your comment')"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-comment">@lang('platform.buttons.post_comment')</button>

        </form>

    </div>

</div><!-- End blog comments -->
@endsection
