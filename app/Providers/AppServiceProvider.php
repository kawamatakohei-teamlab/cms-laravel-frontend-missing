<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        # [CmsCore部分] ここでCmsを初期化する。内容はArticleモデルの設定、Bladeテンプレートの拡張関数設定など
        \App\CmsCore\Init::init();
    }
}
