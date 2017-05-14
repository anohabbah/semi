<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $articles = \App\Article::all();

    return view('welcome', compact('articles'));
});

Route::get('/search', function (\App\Articles\ArticleRepository $repository) {
    $articles = $repository->search(request('q'));

    return view('welcome', compact('articles'));
});
