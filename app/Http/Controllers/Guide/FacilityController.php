<?php

namespace App\Http\Controllers\Guide;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Article\FacilityDetail;

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

        list($displayExtraLargeArticles,
            $displayLargeArticles,
            $displayRegularArticles,
            $displaySmallArticles) = FacilityDetail::getArrayDetailsByFacilityArticle($facilityArticle);

        return view('pages/guide/facility/show', compact(
            'facilityArticle',
            'displayExtraLargeArticles',
            'displayLargeArticles',
            'displayRegularArticles',
            'displaySmallArticles'
        ));
    }
}
