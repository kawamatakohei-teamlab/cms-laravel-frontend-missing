<?php

namespace App\CmsCore\Models;


class Article extends DaisyModelBase
{
    /**
     * 日付をCarbonで取得できるように設定
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'publish_at',
        'expire_at'
    ];

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

    public static function getDefaultTableName()
    {
        # TODO: 切り替わる条件はまだ分からないので、将来は edit_article テーブルも対応。
        return 'view_articles';
    }

}
