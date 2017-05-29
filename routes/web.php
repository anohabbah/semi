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
    return view('index');
});

Route::get('/search', 'SearchController@search')->name('search');

Route::get('recherche', function () {
    return view('resultat');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginController@login');

    Route::post('/attachments', 'AttachmentController@store')->name('attachments.upload');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('logout', 'Auth\LoginController@login')->name('admin.logout');

        Route::get('/', 'DashboardController@index');

        Route::resource('/articles', 'ArticleController', ['except' => ['store']]);

    });
});
