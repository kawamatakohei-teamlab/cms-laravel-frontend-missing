<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;

class DepartmentController extends Controller
{
    public function index()
    {
        $departmentArticles = Article::getArticlesByArticleType(Article::CHANNEL_ARTICLE_TYPE)
            ->get()
            ->sortBy(function($departmentArticle) {
                return $departmentArticle->contents->department_sortnumber;
            });

        $departmentListArticle = Article::getArticlesByArticleType(Article::DEPARTMENT_LIST_ARTICLE_TYPE)->first();
        $introductionRelatedPageArticle = Article::getArticlesByArticleType(Article::INTRODUCTION_RELATED_PAGE_ARTICLE_TYPE)->first();

        return view('pages/department/index', compact(
            'departmentArticles', 'departmentListArticle', 'introductionRelatedPageArticle'
        ));
    }
}
