<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\ArticleController;
use App\Models\Article;
use App\Models\Category;

class TeacherController extends ArticleController
{
    public function index()
    {
        $positionCategories = Category::getCategoriesBySlug(Category::POSITION_PARENT_CATEGORY_SLUG);
        $departmentCategories = Category::getCategoriesBySlug(Category::DEPARTMENT_PARENT_CATEGORY_SLUG);
        $teacherArticles = Article::getArticlesByArticleType(Article::TEACHER_ARTICLE_TYPE)->get();
        
        return view('pages/articles/teacher/index', compact(
            'positionCategories', 'departmentCategories', 'teacherArticles'
        ));
    }
}
