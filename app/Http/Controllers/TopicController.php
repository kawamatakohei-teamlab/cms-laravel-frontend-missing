<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Article\Topic;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $index = "index";
        return view('pages/topic/index', compact('index'));
    }

    public function show($permalink)
    {
        $topicArticle = Topic::findPublishedByPermalinkWithArticleType($permalink, Article::TOPIC_ARTICLE_TYPE);
        if (is_null($topicArticle)) abort(404,"[TopicController] topics article slug: $permalink not exists in DB.");

        $topicArticleDynamicDefinedKeys = Topic::CMS_DYNAMIC_DEFINED_KEYS;

        return view('pages/topic/show', compact(
            'topicArticle', 'topicArticleDynamicDefinedKeys'
        ));
    }
}
