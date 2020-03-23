<?php

namespace App\Models;

use App\CmsCore\Models\Article as CmsCoreArticle;

class Article extends CmsCoreArticle
{
    const CHANNEL_ARTICLE_TYPE = 'channel';
    const FACILITY_DETAIL_ARTICLE_TYPE = 'facility_detail';
    const FACILITY_ARTICLE_TYPE = 'facility';
    const INFO_ARTICLE_TYPE = 'info';
    const TOPIC_ARTICLE_TYPE = 'topics';
    const TEACHER_ARTICLE_TYPE = 'teacher_detail';
    const DEPARTMENT_LIST_ARTICLE_TYPE = 'department_list';
    const INTRODUCTION_RELATED_PAGE_ARTICLE_TYPE = 'introduction_related_page';

    public static function getArticlesByArticleType($type)
    {
        $article_items = self::where('article_type', $type)->publishing()->normalOrder();
        return $article_items;
    }

    public static function findPublishedByPermalinkWithArticleType($permalink, $article_type)
    {
        return self::where('permalink', $permalink)
            ->where('article_type', $article_type)
            ->publishing()
            ->first();
    }

    /**
     * 同一article_typeで、前に公開された記事。
     *
     * @return Article|null
     */
    public function previous()
    {
        // 同一公開日のデータが有った場合、対象の記事id以前のid記事を取得する。
        $samePublishAtArticles = self::where('article_type', $this->article_type)
            ->publishing()
            ->where('publish_at', '=', $this->publish_at)
            ->where('id', '<', $this->id);

        if($samePublishAtArticles->count()) {
            return $samePublishAtArticles
                ->normalOrder()
                ->first();
        }

        // 同一公開日がない場合、対象記事より公開時期が早い記事を取得する
        return self::where('article_type', $this->article_type)
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
        $samePublishAtArticles = self::where('article_type', $this->article_type)->publishing()
            ->where('publish_at', '=', $this->publish_at)
            ->where('id', '>', $this->id);

        if($samePublishAtArticles->count()) {
            return $samePublishAtArticles
                ->reverseOrder()
                ->first();
        }

        // 同一公開日がない場合、対象記事より公開時期が遅い記事を取得する
        return self::where('article_type', $this->article_type)
            ->publishing()
            ->where('publish_at', '>', $this->publish_at)
            ->reverseOrder()
            ->first();
    }


    // ローカルスコープ

    // TODO: 記事を表示する条件をグローバルスコープに置き換えたほうが良いか検討する
    // グローバルスコープにするならCmsCoreの方に移したい
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
