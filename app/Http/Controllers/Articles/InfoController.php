<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\ArticleController;
use App\Models\Category;

class InfoController extends ArticleController
{
    static $INFO_PARENT_CATEGORY_SLUG = 'info_category';

    public function index()
    {
        $infoCategories = Category::getCategoriesBySlug(self::$INFO_PARENT_CATEGORY_SLUG);
        return view('pages/articles/info/index', compact('infoCategories'));
    }

    public function show($key)
    {

        return view('pages/articles/info/show', []);
    }
}
