<?php

namespace App\CmsCore\Models;

class ArticleSearch extends DaisyModelBase
{
    /***
     * この関数で、EloquentBuilderを ArticleSearchBuilder に指定。具体な使い方は ArticleSearchBuilder を参照
     * @param \Illuminate\Database\Query\Builder $query
     * @return ArticleSearchBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new ArticleSearchBuilder($query);
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

    public static function getDefaultTableName()
    {
        # TODO: 切り替わる条件はまだ分からないので、将来は search_edit_article テーブルも対応。
        return 'search_view_article';

    }

    protected static function booted()
    {
        # ArticleSearch が bootした後に、 retrieved eventを登録
        static::retrieved(function (ArticleSearch $article_search) {
            # ArticleのデータはJson文字列の形式で、contentフィルドに保存してるから、JsonからArrayに変換
            if (empty($article_search->contents)) return;

            $content_json = json_decode($article_search->contents);
            foreach ($content_json as $key => $value) {
                # もし記事の内容に DB のカラムと同じ名前のKEYがあるなら、DBのカラムを上書きさせないようにする
                if (isset($article_search->{$key})) continue;
                $article_search->{$key} = $value;
            }
            $article_search->contents = $content_json;
        });
    }
}
