<?php

namespace App\Models\SearchArticle;

use App\Models\Article;
use App\Models\Category;
use App\Models\SearchArticle;
use Illuminate\Database\Eloquent\Builder;

class SearchInfoArticle extends SearchArticle
{
    const INFO_ARTICLE_TYPE = 'info';

    /**
     * 同一article_typeで、前に公開された記事。
     *
     * @param ?Integer $noticeTypeId
     * @return Article|null
     */
    public static function getSameNoticeTypeArticleQuery($noticeTypeId = null): Builder
    {
        $articleIds = [];
        if(!is_null($noticeTypeId)){
            $articleIds = self::getSameNoticeTypeArticleIds($noticeTypeId);
        }

        $articles = Article::getArticlesByArticleType(self::INFO_ARTICLE_TYPE);
        if($articleIds) {
            return $articles->whereIn('id', $articleIds);
        }
        return $articles;
    }


    public static function getSameNoticeTypeArticleIds($noticeTypeId)
    {
        return SearchInfoArticle::where('article_type', self::INFO_ARTICLE_TYPE)
            ->where('content_key', 'notice_type')
            ->where('content_value', 'LIKE', "%\"$noticeTypeId\"%")
            ->pluck('id');
    }
}
