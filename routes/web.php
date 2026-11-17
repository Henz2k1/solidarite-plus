<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/approach', function () {
    return view('approach');
});

Route::get('/events', function () {
    return view('events');
});

Route::get('/blog', function () {
    return view('blog');
});

