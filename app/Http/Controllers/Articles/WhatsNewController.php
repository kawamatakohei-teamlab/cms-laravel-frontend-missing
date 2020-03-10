<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\ArticleController;
use App\Models\Article;
use App\Models\Category;
use App\CmsCore\Models\File;
use App\Models\SearchArticle\SearchInfoArticle;

class WhatsNewController extends ArticleController
{
    public function index()
    {
        $infoCategories = Category::getCategoriesBySlug(Category::INFO_PARENT_CATEGORY_SLUG);
        $infoArticles   = Article::getArticlesByArticleType(SearchInfoArticle::INFO_ARTICLE_TYPE)->paginate(10);

        return view('pages/articles/whats_new/index', compact(
            'infoCategories', 'infoArticles'
        ));
        return view('pages/articles/info/index', compact('infoCategories'));
    }

    public function show($key)
    {
        $infoArticle = Article::findPublishedByPermalinkWithArticleType($key, SearchInfoArticle::INFO_ARTICLE_TYPE);
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
