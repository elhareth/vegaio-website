<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// API Version 1
Route::group([
    'namespace' => 'App\Http\Controllers\API\V1',
    'prefix' => 'v1',
    'as' => 'v1.',
], function () {
    Route::group([], base_path('routes/api/v1/resources.php'));
});
