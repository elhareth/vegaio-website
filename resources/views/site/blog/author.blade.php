@extends('site.blog.index')

@section('head-title', $author->displayName)

@section('blog-breadcrumbs-title')
    {{ $author->getDisplayName()}}
    <br>
    <small dir="ltr"><span>@</span>{{ $author->username }}</small>
@endsection

@section('blog-sidebar')
<h4 class="sidebar-title">@lang('models/article.label.Models'): {{ $articles->count() }}</h4>
<h4 class="sidebar-title">@lang('models/comment.label.Models'): {{ $author->comments_count }}</h4>
@endsection
