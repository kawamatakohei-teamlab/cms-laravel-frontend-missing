<?php

namespace App\Models;

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
    
    public function getContentsAttribute($content_json)
    {
        # ArticleのデータはJsonの形式で、contentフィルドに保存してるから、JsonからArrayに変換
        if (!empty($content_json)) {
            $content_json = json_decode($content_json, true);
        }
        # dynamic partsはJson Stringの中で、Json Stringの形式保存してるので、存在する場合もArrayに変換
        if (isset($content_json['dynamic'])) {
            $content_json['dynamic'] = json_decode($content_json['dynamic'], true);
        }
        return $content_json;
    }
}
