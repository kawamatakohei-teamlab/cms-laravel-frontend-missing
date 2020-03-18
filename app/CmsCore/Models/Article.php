<?php

namespace App\CmsCore\Models;


class Article extends DaisyModelBase
{
    /***
     * この関数で、モデルのEloquentBuilderを ArticleSearchBuilder に指定。具体な使い方は ArticleSearchBuilder を参照
     * @param \Illuminate\Database\Query\Builder $query
     * @return ArticleBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new ArticleBuilder($query);
    }

    /***
     * モデルが作られた時に、動的に使うテーブル名を決める。原因は、将来にviewテーブルからeditテーブルに切り替わる可能性はある
     * ArticleSearch constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable($this::getDefaultTableName());
    }

    protected static function booted()
    {
        # ArticleSearch が bootした後に、 retrieved eventを登録
        static::retrieved(function (Article $article) {
            # ArticleのデータはJson文字列の形式で、contentフィルドに保存してるから、JsonからArrayに変換
            if (empty($article->contents)) return;

            $content_json = json_decode($article->contents);
            foreach ($content_json as $key => $value) {
                # もし記事の内容に DB のカラムと同じ名前のKEYがあるなら、DBのカラムを上書きさせないようにする
                if (isset($article->{$key})) continue;
                $article->{$key} = $value;
            }
            $article->contents = $content_json;
        });
    }

    public static function getDefaultTableName()
    {
        # TODO: 切り替わる条件はまだ分からないので、将来は edit_article テーブルも対応。
        return 'view_articles';
    }

}
