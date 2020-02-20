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

Route::get('assets/styles/{name}', 'AssetsController@stylesheet');

Route::get('assets/javascripts/{name}','AssetsController@javascript');

Route::get('/404',function(){
    return view('/404');
});

Route::get('/', function () {
    return view('welcome');
});

