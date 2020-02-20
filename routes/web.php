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

Route::get('assets/styles/{name}', 'AssetsController@stylesheet')->name('assets.styles');

Route::get('assets/scripts/{name}','AssetsController@javascript')->name('assets.scripts');

Route::get('/assets/materials/{name}', 'AssetsController@material')->name('assets.materials');

Route::get('/', function () {
    return view('welcome');
});

