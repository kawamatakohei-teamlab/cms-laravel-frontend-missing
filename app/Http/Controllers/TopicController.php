<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;

class TopicController extends ArticleController
{
    public function index(Request $request)
    {
        $index = "index";
        return view('pages/articles/topic/index', compact('index'));
    }

    public function show($key)
    {
        $show = $key;
        return view('pages/articles/topic/index', compact('show'));
    }
}
