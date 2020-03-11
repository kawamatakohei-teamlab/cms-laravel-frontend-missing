<?php


namespace App\CmsCore\Models;


use Illuminate\Database\Eloquent\Builder;

class ArticleSearchBuilder extends Builder
{
    private $article_type = null;
    private $lang_code = null;
    private $can_be_showed = true;

    /**
     * @param null $article_type Article Type
     * @param null $lang_code ArticleのLanguage Code
     * @param bool $can_be_showed 公開期限内のものを返すかどうか
     * @return $this
     */
    public function setArticleInfo($article_type = null, $lang_code = null, $can_be_showed = true)
    {
        $this->article_type = $article_type;
        $this->lang_code = $lang_code;
        $this->can_be_showed = $can_be_showed;

        $article_tablename = Article::getDefaultTableName();
        $search_tablename = ArticleSearch::getDefaultTableName();
        # view_article テーブルを search_view_table に join する
        $this->from("$search_tablename as search")->join("$article_tablename as qb", "qb.id", '=', "search.id")->groupBy('qb.id');

        # 記事タイプで検絞る
        if (!is_null($article_type)) $this->where('qb.article_type', $article_type);
        # lang_codeで絞る
        if (!is_null($lang_code)) $this->where('qb.article_language_code', $lang_code);
        # 公開期限内のもののみを返す
        if ($can_be_showed) {
            $now = date("Y-m-d H:i:s");
            $this->where('qb.publish_at', '<=', $now)->where('qb.expire_at', '>', $now);
        }
        return $this;
    }

    /***
     * 記事の内容で検索 ロジックは AND
     * @param $content_key 記事内容のKey
     * @param $operation 検索する時に使う操作方法（SQL文が支援できるもの、 =, >, <, など）
     * @param $content_value 記事の内容
     * @return $this
     */
    public function searchContent($content_key, $operation, $content_value)
    {
        # 記事の内容で検索 ロジックは AND
        $this->where(function ($query) use ($content_key, $operation, $content_value) {
            $query->where('search.content_key', $content_key)->where('search.content_value', $operation, $content_value);
        });
        return $this;
    }

    /***
     * 記事の内容で検索 ロジックは OR
     * @param $content_key 記事内容のKey
     * @param $operation 検索する時に使う操作方法（SQL文が支援できるもの、 =, >, <, など）
     * @param $content_value 記事の内容
     * @return $this
     */
    public function searchContentOr($content_key, $operation, $content_value)
    {
        $this->OrWhere(function ($query) use ($content_key, $operation, $content_value) {
            $query->where('search.content_key', $content_key)->where('search.content_value', $operation, $content_value);
        });
        return $this;
    }

    public function orderByContentValue($content_key,)

    /***
     * Limitを設定
     * @param $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit($limit);
        return $this;
    }
}
