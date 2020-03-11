<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\ArticleController;
use App\CmsCore\Models\Article;
use App\CmsCore\Models\Category;

class TeacherController extends ArticleController
{
    static $POSITION_PARENT_CATEGORY_SLUG = 'position';
    static $DEPARTMENT_PARENT_CATEGORY_SLUG = 'department';
    static $TEACHER_ARTICLE_TYPE = 'teacher_detail';

    public function index()
    {
        $positionCategories = Category::getCategoriesBySlug(self::$POSITION_PARENT_CATEGORY_SLUG);
        $departmentCategories = Category::getCategoriesBySlug(self::$DEPARTMENT_PARENT_CATEGORY_SLUG);
        $teacherArticles = Article::getArticlesByArticleType(self::$TEACHER_ARTICLE_TYPE)->get();
        
        return view('pages/articles/teacher/index', compact(
            'positionCategories', 'departmentCategories', 'teacherArticles'
        ));
    }
}
