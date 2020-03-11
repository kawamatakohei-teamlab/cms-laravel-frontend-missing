<?php

/***
 * 毎回 \App\CmsCore\Models\ArticleSearchで記事検索は面倒から、一応 ArticleSearch のHelper関数を作った。使い方はモデルArticleSearchを参照
 * @param null $article_type
 * @param null $lang_code
 * @param bool $can_be_showed
 * @return mixed
 */
function ArticleSearch($article_type = null, $lang_code = null, $can_be_showed = true)
{
    return \App\CmsCore\Models\ArticleSearch::setArticleInfo($article_type, $lang_code, $can_be_showed);
}
