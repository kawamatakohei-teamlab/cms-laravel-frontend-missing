<?php


namespace App\CmsCore\Models;


use Illuminate\Database\Eloquent\Builder;

class ArticleBuilder extends Builder
{
    /**
     * @param null $article_type Article Type
     * @param null $lang_code ArticleのLanguage Code
     * @param bool $can_be_showed 公開期限内のものを返すかどうか
     * @return $this
     */
    public function setArticleInfo($article_type = null, $lang_code = null, $can_be_showed = true){
        if (!is_null($article_type)) $this->setArticleType($article_type);
        if (!is_null($lang_code)) $this->setLangCode($lang_code);
        if ($can_be_showed) $this->setPublishedOnly();
        return $this;

    }
    /***
     * 記事のIDsが分かるなら、直接IDを指定できる
     * @param array $article_ids 記事のID値（数列）
     * @return ArticleBuilder
     */
    public function setArticleIds(array $article_ids)
    {
        return $this->whereIn('id', $article_ids);
    }

    /***
     * 直接記事のIDを指定する（同時はLimit(1)を自動で設定する
     * @param array $article_id 記事のID値
     * @return ArticleBuilder
     */
    public function setArticleId($article_id)
    {
        return $this->where('id',$article_id)->limit(1);
    }

    /**
     * この関数を呼び出すと、公開期間内の記事しか返さない（ 公開開始日 <= 現在時間 < 公開終了日 の記事）
     * @return ArticleBuilder
     */
    public function setPublishedOnly()
    {
        $now = date("Y-m-d H:i:s");
        return $this->where('publish_at', '<=', $now)->where('expire_at', '>', $now);

    }

    /**
     * LangCodeを設定
     * @return ArticleBuilder
     */
    public function setLangCode($lang_code)
    {
        return $this->where('article_language_code', $lang_code);

    }

    /***
     * 記事タイプを設定
     * @param $article_type
     * @return ArticleBuilder
     */
    public function setArticleType($article_type)
    {
        return $this->where('article_type', $article_type);
    }

    /***
     * 記事の permalink を設定
     * @param $permalink_name
     * @return ArticleBuilder
     */
    public function setPermalink($permalink_name)
    {
        return $this->where('permalink', $permalink_name);
    }

    public function setlimit($limit)
    {
        return $this->limit($limit);
    }

}
