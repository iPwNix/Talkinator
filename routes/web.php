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
    return view('welcome');
});

Route::get('/users/{username}', 'ProfileController@show')->name('showProfile');

Route::middleware(['auth'])->group(function () {
    Route::get('/users/{username}/settings', 'ProfileController@editingInfo')->name('editInfo');
    Route::post('/users/{username}/settings', 'ProfileController@updateInfo')->name('updateInfo');
    Route::get('/users/{username}/settings/avatar', 'ProfileController@editingAvatar')->name('editAvatar');
    Route::post('/users/{username}/settings/avatar', 'ProfileController@updateAvatar')->name('updateAvatar');
    Route::get('/users/{username}/settings/cover', 'ProfileController@editingCover')->name('editCover');
    Route::post('/users/{username}/settings/cover', 'ProfileController@updateCover')->name('updateCover');
});

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});

Route::get('/home', 'HomeController@index')->name('home');
