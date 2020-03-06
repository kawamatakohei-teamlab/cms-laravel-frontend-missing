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
        # dynamic partsはJson Stringの中で、Json Stringの形式保存してるので、存在する場合もArrayに変換
        if (isset($content_json['dynamic'])) {
            $article->dynamic = json_decode($content_json['dynamic']);
        }
    }
}
