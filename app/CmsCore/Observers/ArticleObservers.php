<?php


namespace App\CmsCore\Observers;


use App\CmsCore\Models\Article;

class ArticleObservers
{
    public function retrieved(Article $article)
    {
        # ArticleのデータはJsonの形式で、contentフィルドに保存してるから、JsonからArrayに変換
        if (empty($article->contents)) return;

        $content_json = json_decode($article->contents, true);
        foreach ($content_json as $key => $value) {
            $article->{$key} = $value;
        }
        $article->contents = $content_json;
    }
}
