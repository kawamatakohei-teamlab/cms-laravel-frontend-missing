<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\ArticleController;
use App\Models\Article;

class DepartmentController extends ArticleController
{
    public function index()
    {
        $departmentArticles = Article::getArticlesByArticleType(Article::CHANNEL_ARTICLE_TYPE)
            ->get()
            ->sortBy(function($departmentArticle) {
                $contents = json_decode($departmentArticle->contents);
                return $contents->department_sortnumber;
            });

        $departmentListArticle = Article::getArticlesByArticleType(Article::DEPARTMENT_LIST_ARTICLE_TYPE)->first();    
        $introductionRelatedPageArticle = Article::getArticlesByArticleType(Article::INTRODUCTION_RELATED_PAGE_ARTICLE_TYPE)->first();

        return view('pages/articles/department/index', compact(
            'departmentArticles', 'departmentListArticle', 'introductionRelatedPageArticle'
        ));
    }
}
