<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class TeacherController extends Controller
{
    public function index()
    {
        $positionCategories = Category::getCategoriesBySlug(Category::POSITION_PARENT_CATEGORY_SLUG);
        $departmentCategories = Category::getCategoriesBySlug(Category::DEPARTMENT_PARENT_CATEGORY_SLUG);
        $teacherArticles = Article::getArticlesByArticleType(Article::TEACHER_ARTICLE_TYPE)->get();

        return view('pages/teacher/index', compact(
            'positionCategories', 'departmentCategories', 'teacherArticles'
        ));
    }
}
