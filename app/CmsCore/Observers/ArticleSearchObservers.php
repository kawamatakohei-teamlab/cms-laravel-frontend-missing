<?php


namespace App\CmsCore\Observers;


use App\CmsCore\Models\ArticleSearch;

class ArticleSearchObservers
{
    public function retrieved(ArticleSearch $article_search)
    {
        # ArticleのデータはJsonの形式で、contentフィルドに保存してるから、JsonからArrayに変換
        if (empty($article_search->contents)) return;

        $content_json = json_decode($article_search->contents, true);
        foreach ($content_json as $key => $value) {
            $article_search->{$key} = $value;
        }
        $article_search->contents = $content_json;
    }
}
