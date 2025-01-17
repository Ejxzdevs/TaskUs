<?php

use Illuminate\Support\Facades\Route;

Route::get('/w', function () {
    return view('login');
});

Route::get('/', function () {
    return view('layout.app');
});

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

