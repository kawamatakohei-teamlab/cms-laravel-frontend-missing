<?php

namespace App\Models\Article;

use App\Models\Article;

class FacilityDetail extends Article
{
    /**
     * 施設案内の記事から、それぞれ指定の表示サイズに合わせた施設詳細のレコードを取得する
     * @param Article $facilityArticle
     * @return array [xl_details, l_details, m_details, s_details]
     */
    public static function getArrayDetailsByFacilityArticle(Article $facilityArticle)
    {
        // $facilityArticleのarticle_typeが違った場合はエラーとする
        if ($facilityArticle->article_type !== Article::FACILITY_ARTICLE_TYPE) {
            abort(500, "[FacilityDetail] getArrayDetailsByFacilityArticle params: facilityArticle->article_type is not FACILITY_ARTICLE_TYPE.");
        }

        // 表示サイズごとに設定された記事IDを配列として取得
        $xlFacilityIds  = explode(config('consts.utils.COMMA'), $facilityArticle->display_extra_large_facility_ids);
        $lFacilityIds   = explode(config('consts.utils.COMMA'), $facilityArticle->display_large_facility_ids);
        $mFacilityIds   = explode(config('consts.utils.COMMA'), $facilityArticle->display_medium_facility_ids);
        $sFacilityIds = explode(config('consts.utils.COMMA'), $facilityArticle->display_small_facility_ids);

        // 指定された記事データを取得
        $facilityDetailArticleIds = array_merge($xlFacilityIds, $lFacilityIds, $mFacilityIds, $sFacilityIds);
        $facilityDetailArticles = Article::getArticlesByArticleType(Article::FACILITY_DETAIL_ARTICLE_TYPE)
            ->whereIn('id', $facilityDetailArticleIds)
            ->get();

        // 取得した記事データから指定のIDを抽出し、返却する。
        return [
            self::dripDetailArticlesByIds($facilityDetailArticles, $xlFacilityIds),
            self::dripDetailArticlesByIds($facilityDetailArticles, $lFacilityIds),
            self::dripDetailArticlesByIds($facilityDetailArticles, $mFacilityIds),
            self::dripDetailArticlesByIds($facilityDetailArticles, $sFacilityIds),
        ];
    }



    /**
     * facilityDetailArticlesとして取得したcollectionからidsに含まれるものを抽出し、配列として返却する
     * @param Collection $facilityDetailArticles
     * @param Array $ids ["1","2",....]
     * @return Array
     */
    private static function dripDetailArticlesByIds($facilityDetailArticles, $ids)
    {
        $result = [];
        foreach ($ids as $id) {
            $facilityDetailArticle = $facilityDetailArticles->first(function ($facilityDetailArticle) use ($id) {
                return $facilityDetailArticle->id === intval($id);
            });
            if ($facilityDetailArticle) {
                array_push($result, $facilityDetailArticle);
            }
        }
        return $result;
    }
}
