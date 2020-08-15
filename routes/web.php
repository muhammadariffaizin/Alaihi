<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('user')->middleware('is_user')->group(function() {
    Route::get('home', 'HomeController@index')->name('user.home');
});

Route::prefix('admin')->middleware('is_admin')->group(function() {
    Route::get('home', 'HomeController@admin')->name('admin.home');
    Route::get('settings', 'SettingController@admin')->name('admin.settings');
    Route::post('update', 'SettingController@update')->name('admin.update');
    Route::post('update_password', 'SettingController@update_password')->name('admin.password');
    
    Route::prefix('genre')->group(function() {
        Route::get('/{id}', 'GenreController@index')->name('genre.index');
        Route::post('/create', 'GenreController@create')->name('genre.create');
    });
    
    Route::prefix('song')->group(function() {
        Route::get('/list', 'SongController@list')->name('song.list');
        Route::get('/list/search', 'SearchController@search')->name('song.search');
        Route::get('/{id}', 'SongController@index')->name('song.index');
        Route::post('/create', 'SongController@create')->name('song.create');
        Route::get('/edit/{id}', 'SongController@edit')->name('song.edit');
        Route::post('/update', 'SongController@update')->name('song.update');
        Route::get('/delete/{id}', 'SongController@delete')->name('song.delete');
    });
    
    Route::prefix('lyric')->group(function() {
        Route::post('/create', 'LyricController@create')->name('lyric.create');
        Route::get('/edit/{id}', 'LyricController@edit')->name('lyric.edit');
        Route::post('/update', 'LyricController@update')->name('lyric.update');
        Route::get('/delete/{id}', 'LyricController@delete')->name('lyric.delete');
        Route::get('/duplicate/{id}', 'LyricController@duplicate')->name('lyric.duplicate');
    });
    
    Route::prefix('sublyric')->group(function() {
        Route::get('/{id}', 'SubLyricController@index')->name('sublyric.index');
        Route::get('/edit/{id}', 'SubLyricController@edit')->name('sublyric.edit');
        Route::post('/create', 'SubLyricController@create')->name('sublyric.create');
        Route::post('/update', 'SubLyricController@update')->name('sublyric.update');
        Route::get('/delete/{id}', 'SubLyricController@delete')->name('sublyric.delete');
    });
});

