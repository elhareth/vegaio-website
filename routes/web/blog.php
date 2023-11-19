<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'controller' => 'BlogController',
    'prefix' => 'blog',
    'as' => 'blog.',
], function () {
    Route::get('/', 'index')->name('index');


    Route::get('article/{article:slug}', 'article')->name('article');
    Route::post('article/{article:slug}/comment', 'article_comment')->name('article.comment');

    Route::get('author/{user:username}', 'author')->name('author');

    Route::get('category/{category:slug}', 'category')->name('category');
    Route::get('category/{category:slug}/{article:slug}', 'category_article')->name('category.article');
    Route::post('category/{category:slug}/{article:slug}/comment', 'category_article_comment')->name('category.article.comment');
});
