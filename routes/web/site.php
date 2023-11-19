<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', 'home')->name('home');
Route::get('/about', 'about')->name('about');
Route::match(['get', 'post'], '/contact', 'contact')->name('contact');
Route::get('/tos', 'tos')->name('tos');
Route::get('/policy', 'policy')->name('policy');

// Mods
Route::get('/services', 'services')->name('services');
Route::get('/services/{service:slug}', 'service')->name('service');
