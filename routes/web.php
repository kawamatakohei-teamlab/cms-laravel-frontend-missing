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
// トップページ
Route::get('/', 'TopController@index' )->name('top.index');

Route::prefix('guide')->group(function () {
    // 大学案内TOP
    Route::get('/', 'GuideController@index')->name('guide_index');

    // // 詳細（孫）
    // Route::get('/detail/{permalink}', 'Guide\FacilityController@index')
    //     ->where('permalink', '.+')
    //     ->name('guide_facility_index');

    // // キャンパスマップ
    // Route::get('/campasmap/{permalink}', 'Guide\FacilityController@index')
    //     ->where('permalink', '.+')
    //     ->name('guide_facility_index');

    // 施設案内 + 施設詳細
    Route::get('/{permalink}', 'Guide\FacilityController@index')
        ->where('permalink', '.+')
        ->name('guide_facility_index');
});

// お知らせ
Route::get('/whatsnew/{key}', 'Articles\WhatsNewController@show')->name('whats_new_show');
Route::get('/whatsnew',       'Articles\WhatsNewController@index')->name('whats_new_index');

// 教員
Route::get('/teachers', 'Articles\TeacherController@index')->name('teacher_index');

// 学科
Route::get('/departments', 'Articles\DepartmentController@index')->name('department_index');
