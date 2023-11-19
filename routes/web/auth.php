<?php

use Illuminate\Support\Facades\Route;

// Login
Route::get('login', 'show_login_page')->name('login');
Route::post('login', 'login');

// Register
Route::get('register', 'show_register_page')->name('register');
Route::post('register', 'register');

// Password
Route::prefix('password')->as('password.')->group(function () {

    Route::get('confirm', 'show_confirm_password_page')->name('confirm');
    Route::post('confirm', 'confirm_password');

    Route::get('forgot', 'show_forgot_password_page')->name('request');
    Route::post('forgot', 'forgot_password')->name('email');

    Route::post('reset', 'reset_password')->name('update');
    Route::get('reset/{token}', 'show_reset_password_page')->name('reset');

});


// Verification
Route::prefix('email')->as('verification.')->group(function () {

    Route::get('verify', 'show_verify_email_page')->name('notice');
    Route::get('verify/{id}/{hash}', 'verify_email')->name('verify');
    Route::post('request/link', 'send_verify_email')->name('send');

});
