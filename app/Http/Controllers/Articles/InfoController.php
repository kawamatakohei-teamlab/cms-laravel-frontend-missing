<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\ArticleController;
use App\Models\Article;
use App\Models\Category;

class InfoController extends ArticleController
{
    static $INFO_PARENT_CATEGORY_SLUG = 'info_category';
    static $INFO_ARTICLE_TYPE         = 'info';

    public function index()
    {
        $infoCategories = Category::getCategoriesBySlug(self::$INFO_PARENT_CATEGORY_SLUG);
        $infoArticles   = Article::getArticlesByArticleType(self::$INFO_ARTICLE_TYPE)->paginate(10);

        return view('pages/articles/info/index', compact(
            'infoCategories', 'infoArticles'
        ));
    }

    public function show($key)
    {

        return view('pages/articles/info/show', []);
    }
}
