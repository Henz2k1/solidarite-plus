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

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/blog-detail', function () {
    return view('blog-detail');
});

// Route pour afficher un article spécifique via son identifiant ou son slug
//Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');


