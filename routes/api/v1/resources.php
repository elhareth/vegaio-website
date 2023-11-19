<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('users', 'UserController');

Route::apiResource('options', 'SiteOptionController');

Route::apiResource('categories', 'CategoryController');

Route::apiResource('services', 'ServiceController');

Route::apiResource('articles', 'ArticleController');

Route::apiResource('comment', 'CommentController');
