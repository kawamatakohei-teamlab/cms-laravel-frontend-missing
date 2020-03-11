<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\ArticleController;
use App\Models\Article;
use App\Models\Category;
use App\CmsCore\Models\File;
use App\Models\SearchArticle\SearchInfoArticle;
use Illuminate\Http\Request;

class WhatsNewController extends ArticleController
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

        return view('pages/articles/whats_new/index', compact(
            'infoCategories', 'filterCategory', 'infoArticles'
        ));
        return view('pages/articles/info/index', compact('infoCategories'));
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
        // 対象記事のcontentsに紐づくすべてのファイル
        $files = $this->getFilesByInfoArticle($infoArticle);

        // 対象記事と同一notice_typeの記事を取得
        $sameInfoCategoryArticles = SearchInfoArticle::getSameNoticeTypeArticleQuery($infoCategory ? $infoCategory->id : null)
            ->limit(4)
            ->get();

        return view('pages/articles/whats_new/show', compact(
            'infoCategory', 'infoArticle', 'files', 'sameInfoCategoryArticles'
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

    /**
     * Aticleに紐づく動的コンテンツ要素が必要とする静的ファイルをすべて取得する
     *
     * @param Article $infoArticle
     * @return Collection
     */
    private function getFilesByInfoArticle($infoArticle)
    {
        $useUploadFileContentsKeys = [
            'notice_image',
            'notice_pdf'
        ];

        $contents = json_decode($infoArticle->contents);

        $idList = [];
        foreach ($contents->dynamic as $dynamic) {
            foreach ($useUploadFileContentsKeys as $key) {
                if(property_exists($dynamic, $key)){
                    $idList[] = $dynamic->$key;
                }
            }
        }

        return File::whereInByIdList($idList)->get();
    }
}
