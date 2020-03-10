<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\ArticleController;
use App\Models\Article;
use App\Models\Category;

class TeacherController extends ArticleController
{
    public function index()
    {
        return view('pages/articles/teacher/index');
    }
}
