<?php


namespace App\Http\Controllers\Nicho;


use App\Models\Article;

class Utils
{
    public static function getAllStores()
    {
        # TODO: redis周りを対応
        $stores = Article::getArticlesByArticleType('store');
        return $stores;
    }

}
