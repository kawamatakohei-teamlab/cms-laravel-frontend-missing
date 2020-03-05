<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\ArticleController;

class InfoController extends ArticleController
{
    public function index()
    {

        return view('pages/articles/info/index', $this->controllerData());
    }

    public function show($key)
    {

        return view('pages/articles/info/show', $this->controllerData());
    }
}
