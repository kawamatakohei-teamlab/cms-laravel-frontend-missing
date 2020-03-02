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
Route::prefix('assets')->group(function () {
    Route::get('styles/{name}', 'AssetsController@stylesheet')->name('assets.styles');
    Route::get('scripts/{name}','AssetsController@javascript')->name('assets.scripts');
    Route::get('materials/{name}', 'AssetsController@material')->name('assets.materials');
});

Route::get('files/{name}','AssetsController@file')->name('assets.files');

Route::get('images/{thumb_size}/{name}','AssetsController@image')->name('assets.image');


Route::get('/', 'Nicho\GeneralIndexController@index' )->name('general_index');
Route::get('/test', "TestController@index");

Route::get('/info/{permalink}','Nicho\GeneralIndexController@notice_detail')->name('general_notice_detail');
Route::get('/info','Nicho\GeneralIndexController@notice_list')->name('general_notice_list');

