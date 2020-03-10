<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\ArticleController;
use App\Models\Article;
use App\Models\Category;
use App\CmsCore\Models\File;

class WhatsNewController extends ArticleController
{
    static $INFO_PARENT_CATEGORY_SLUG = 'info_category';
    static $INFO_ARTICLE_TYPE         = 'info';

    public function index()
    {
        $infoCategories = Category::getCategoriesBySlug(self::$INFO_PARENT_CATEGORY_SLUG);
        $infoArticles   = Article::getArticlesByArticleType(self::$INFO_ARTICLE_TYPE)->paginate(10);

        return view('pages/articles/whats_new/index', compact(
            'infoCategories', 'infoArticles'
        ));
    }

    public function show($key)
    {
        $infoCategories = Category::getCategoriesBySlug(self::$INFO_PARENT_CATEGORY_SLUG);
        $infoArticle = Article::findPublishArticleByPermalink($key);

        $files = $this->getFilesByInfoArticle($infoArticle);

        return view('pages/articles/whats_new/show', compact(
            'infoCategories', 'infoArticle', 'files'
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
