<?php

namespace App\Http\Controllers\Nicho;

use App\Models\Article;
use Illuminate\Http\Request;

class GeneralIndexController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $article = Article::getArticleByID(1);
        $general_top_infos = Article::getArticlesByArticleType('general_top');
        $general_top_info = $general_top_infos->first();

        $important_notice = Article::getArticlesByArticleType('important_notice_at_general');
        $important_notice = $important_notice->first();

        $stores = Utils::getAllStores();
        $stores =  $stores->take($stores->count())->get();
        $datas = [
            'body_id' => 'topGeneral',
            'body_class' => '',
            'general_top_info' => $general_top_info->contents,
            'important_notice' => $important_notice,
            'area_list' => Utils::$area_list,
            'checkbox_lists' => Utils::$checkbox_lists,
        ];
        return view('general_index', $datas);
    }

}
