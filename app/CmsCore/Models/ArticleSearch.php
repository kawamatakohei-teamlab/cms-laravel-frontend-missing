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


}
