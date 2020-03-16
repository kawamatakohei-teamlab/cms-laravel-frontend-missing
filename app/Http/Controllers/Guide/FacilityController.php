<?php

namespace App\Http\Controllers\Guide;

use App\Http\Controllers\Controller;
use App\Models\Article;

class FacilityController extends Controller
{
    /**
     * 施設案内TOP
     */
    public function show($permalink)
    {
        // 施設案内の記事取得
        $facilityArticle = Article::findPublishedByPermalinkWithArticleType($permalink, Article::FACILITY_ARTICLE_TYPE);
        if (is_null($facilityArticle)) abort(404,"[FacilityController] facility article slug: $permalink not exists in DB.");

        // 施設詳細の記事取得
        $getFacilityList = json_decode($facilityArticle->contents)->get_facility_list;
        $facilityDetailArticles = Article::getArticlesByArticleType(Article::FACILITY_DETAIL_ARTICLE_TYPE);
        if(is_null($getFacilityList) || empty($getFacilityList)){
            $facilityDetailArticles = $facilityDetailArticles->get();
        } else {
            // 取得記事に指定があればそのとおり取得する
            // TODO: 取得順序をどうするか確認する。
            $facilityDetailArticles = $facilityDetailArticles
                ->setArticleIds(explode(config('const.utils.COMMA'), $getFacilityList))
                ->get();
        }

        return view('pages/guide/facility/show', compact(
            'facilityArticle', 'facilityDetailArticles'
        ));
    }
}
