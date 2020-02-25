<?php

namespace App\Models;

use App\Events\ArticleQueried;

class Article extends DaisyModelBase
{
    protected $table = 'view_articles';

    public static function getArticleByID($id): ?Article
    {
        $article_item = Article::where('article_id', $id)->first();
        return $article_item;
    }

    public static function getArticlesByArticleType($type)
    {
        $article_items = Article::where('article_type', $type);
        return $article_items;
    }

    public static function getArticlesByContentJsonValue($article_type, $json_key, $json_value, $limit = null)
    {
        $qb = Article::where('article_type', $article_type)->whereJsonContains("contents->$json_key", $json_value);
        if (empty($limit)) {
            return $qb->get();
        } else {
            return $qb->limit($limit)->get();
        }
    }

}
