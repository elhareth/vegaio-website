<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::namespace('\App\Http\Controllers\Web')->group(function () {

    //
    Route::get('/', 'SiteController@index')->name('index');

    // Auth
    Route::controller('AuthController')->group(base_path('routes/web/auth.php'));

    // Site
    Route::group([
        'controller' => 'SiteController',
    ], base_path('routes/web/site.php'));

    // User
    Route::controller('UserController')->group(base_path('routes/web/user.php'));

    // Blog
    Route::group([], base_path('routes/web/blog.php'));

    // Resources
    Route::resources([
        // '/r/users'         => 'UserController',
        // '/r/categories'    => 'CategoryController',
        // '/r/services'      => 'ServiceController',
        // '/r/articles'      => 'ArticleController',
        // '/r/comments'      => 'CommentController',
    ], []);
});
