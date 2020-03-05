<?php
# CoreのRouteを読み込み、assetsなどのrouteを設定。普段はCore以外の人触らなくてもいい
require __DIR__.'/../app/CmsCore/Routes/web.php';
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
Route::get('/', 'Nicho\GeneralIndexController@index' )->name('general_index');

// お知らせ
Route::get('/info/{key}', 'Articles\InfoController@show')->name('info_show');
Route::get('/info',       'Articles\InfoController@index')->name('info_index');
