<?php

namespace App\Models;

class Article extends DaisyModelBase
{
    protected $table = 'view_articles';

    /**
     * 日付を変形する属性
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'publish_at',
        'expire_at'
    ];

    public static function getArticleByID($id): ?Article
    {
        $article_item = Article::where('article_id', $id)->first();
        return $article_item;
    }

    public static function getArticlesByArticleType($type)
    {
        $article_items = Article::where('article_type', $type)->publishing();
        return $article_items;
    }

    public static function getArticlesByArticleTypeAndPublicAt($article_type,$operator,$publish_at)
    {
        $article_items = Article::where('article_type', $article_type)->where('publish_at', $operator, $publish_at)->orderBy('publish_at', 'desc')->get();
        return $article_items;
    }

    public static function getArticlesByArticleTypeAndRangePublicAt($article_type,$start_publish,$end_publish)
    {
        $article_items = Article::where('article_type', $article_type)->where('publish_at', $start_publish["operator"], $start_publish["publish_at"])->where('publish_at', $end_publish["operator"], $end_publish["publish_at"])->orderBy('publish_at', 'desc')->get();
        return $article_items;
    }

    public static function getArticlesByArticleTypeAndPermalink($article_type,$permalink)
    {
        $article_items = Article::where('article_type', $article_type)->where('permalink',$permalink)->first();
        return $article_items;
    }

    public static function getArticlesByContentJsonValue($article_type, $json_key, $json_value, $limit = null)
    {
        $qb = Article::where('article_type', $article_type)->whereJsonContains("contents->$json_key", $json_value)->orderBy('publish_at','desc');
        if (empty($limit)) {
            return $qb->get();
        } else {
            return $qb->limit($limit)->get();
        }
    }

    // ローカルスコープ

    // TODO: 記事を表示する条件をグローバルスコープに置き換えたほうが良いか検討する
    public function scopePublishing($query)
    {
        return $query->where('status', '=', 'publishing');
    }
}
