<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'view_articles';
    const TEACHER_ARTICLE_TYPE = 'teacher_detail';

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
        $article_items = Article::where('article_type', $type)->publishing()->normalOrder();
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

    public static function findPublishedByPermalinkWithArticleType($permalink, $article_type)
    {
        return Article::where('permalink', $permalink)
            ->where('article_type', $article_type)
            ->publishing()
            ->first();
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

    /**
     * 同一article_typeで、前に公開された記事。
     *
     * @return Article|null
     */
    public function previous()
    {
        // 同一公開日のデータが有った場合、対象の記事id以前のid記事を取得する。
        $samePublishAtArticles = Article::where('article_type', $this->article_type)
            ->publishing()
            ->where('publish_at', '=', $this->publish_at)
            ->where('id', '<', $this->id);

        if($samePublishAtArticles->count()) {
            return $samePublishAtArticles
                ->normalOrder()
                ->first();
        }

        // 同一公開日がない場合、対象記事より公開時期が早い記事を取得する
        return Article::where('article_type', $this->article_type)
            ->where('publish_at', '<', $this->publish_at)
            ->normalOrder()
            ->first();
    }

    /**
     * 同一article_typeで、次に公開された記事。
     *
     * @return Article|null
     */
    public function next()
    {
        // 同一公開日のデータが有った場合、対象の記事id以降のid記事を取得する。
        $samePublishAtArticles = Article::where('article_type', $this->article_type)->publishing()
            ->where('publish_at', '=', $this->publish_at)
            ->where('id', '>', $this->id);

        if($samePublishAtArticles->count()) {
            return $samePublishAtArticles
                ->reverseOrder()
                ->first();
        }

        // 同一公開日がない場合、対象記事より公開時期が遅い記事を取得する
        return Article::where('article_type', $this->article_type)
            ->publishing()
            ->where('publish_at', '>', $this->publish_at)
            ->reverseOrder()
            ->first();
    }


    // ローカルスコープ

    // TODO: 記事を表示する条件をグローバルスコープに置き換えたほうが良いか検討する
    // 公開中の記事を取得
    public function scopePublishing($query)
    {
        return $query->where('status', '=', 'publishing');
    }

    // 公開順かつ、ID順にソートする
    public function scopeNormalOrder($query)
    {
        return $query->orderBy('publish_at', 'desc')
            ->orderBy('id', 'desc');
    }
    // 公開順、ID順を逆順にソートする
    public function scopeReverseOrder($query)
    {
        return $query->orderBy('publish_at', 'asc')
            ->orderBy('id', 'asc');
    }
}
