<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\SearchArticle\SearchInfoArticle;
use Illuminate\Http\Request;

class WhatsNewController extends Controller
{
    public function index(Request $request)
    {

        $infoCategories = Category::getCategoriesBySlug(Category::INFO_PARENT_CATEGORY_SLUG);
        $filterCategory = self::checkFillterCategory($request, $infoCategories);

        if(is_null($filterCategory)){
            $infoArticles = Article::getArticlesByArticleType(Article::INFO_ARTICLE_TYPE)
                ->paginate(10);
        } else {
            $infoArticles = SearchInfoArticle::getSameNoticeTypeArticleQuery($filterCategory->id)
                ->paginate(10);
        }

        return view('pages/whats_new/index', compact(
            'infoCategories', 'filterCategory', 'infoArticles'
        ));
    }

    public function show($key)
    {
        $infoArticle = Article::findPublishedByPermalinkWithArticleType($key, Article::INFO_ARTICLE_TYPE);
        if (is_null($infoArticle)) abort(404,"[ArticleController] info article slug: $key not exists in DB.");

        $contents = json_decode($infoArticle->contents);
        $infoCategories = Category::getCategoriesBySlug(Category::INFO_PARENT_CATEGORY_SLUG);
        $infoCategory = $infoCategories->first(function ($infoCategory) use ($contents){
            return $infoCategory->id == $contents->notice_type[0];
        });

        // 対象記事と同一notice_typeの記事を取得
        $sameInfoCategoryArticles = SearchInfoArticle::getSameNoticeTypeArticleQuery($infoCategory ? $infoCategory->id : null)
            ->limit(4)
            ->get();

        return view('pages/whats_new/show', compact(
            'infoCategory', 'infoArticle', 'sameInfoCategoryArticles'
        ));
    }


    /**
     * $infoCategoriesの中からGET['category']として飛んできたslugが存在するかチェックし、存在すれば対象のcategoryを返す
     *
     * @param Article $infoArticle
     * @return String|null
     */
    public static function checkFillterCategory(Request $request, $infoCategories)
    {
        $categorySlug = $request->input('category');
        $filterCategory = $infoCategories->first(function ($infoCategory) use ($categorySlug){
            return $infoCategory->slug == $categorySlug;
        });
        return $filterCategory ? $filterCategory : null;
    }
}
