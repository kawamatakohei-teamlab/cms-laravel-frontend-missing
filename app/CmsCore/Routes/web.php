<?php
# /assets/styles/xxx /assets/scripts/xxx などのrouteを設定
Route::namespace('\App\CmsCore\Controllers')->prefix('assets')->group(function () {
    Route::get('styles/{name}', 'AssetsController@stylesheet')->name('assets.css');
    Route::get('scripts/{name}','AssetsController@javascript')->name('assets.js');
    Route::get('materials/{name}', 'AssetsController@material')->name('assets.material');

    Route::get('images/{thumb_size}/id/{id}','AssetsController@image')->name('assets.image.id');
    Route::get('images/{thumb_size}/name/{name}','AssetsController@image')->name('assets.image.name');
    Route::get('files/name/{name}','AssetsController@file')->name('assets.file.name');
    Route::get('files/id/{id}','AssetsController@file')->name('assets.file.id');

});
