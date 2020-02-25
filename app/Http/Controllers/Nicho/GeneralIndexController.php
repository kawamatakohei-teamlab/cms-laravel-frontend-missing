<?php

namespace App\Http\Controllers\Nicho;

use App\Models\Article;
use Illuminate\Http\Request;

class GeneralIndexController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $article = Article::getArticleByID(1);
        $top_banner_infos = Article::getArticlesByArticleType('general_top');
        $top_banner_info = $top_banner_infos->first();

        $important_notice = Article::getArticlesByArticleType('important_notice_at_general');
        $important_notice = $important_notice->first();

        $stores = Utils::getAllStores();
        $stores =  $stores->take($stores->count())->get();
        $datas = [
            'body_id' => 'topGeneral',
            'body_class' => '',
            'banner_info' => $top_banner_info->contents,
            'important_notice' => $important_notice
        ];
        return view('general_index', $datas);
    }

}
