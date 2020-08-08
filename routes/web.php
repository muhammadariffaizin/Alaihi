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
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/song/{id}', 'SongController@index')->name('song.detail');
Route::post('/song/create', 'SongController@create')->name('song.create');
Route::post('/lyric/create', 'LyricController@create')->name('lyric.create');
Route::get('/sublyric/{id}', 'SubLyricController@index')->name('sublyric.index');
Route::get('/sublyric/edit/{id}', 'SubLyricController@edit')->name('sublyric.edit');
Route::post('/sublyric/create', 'SubLyricController@create')->name('sublyric.create');
Route::post('/sublyric/update', 'SubLyricController@update')->name('sublyric.update');
Route::get('/sublyric/delete/{id}', 'SubLyricController@delete')->name('sublyric.delete');
