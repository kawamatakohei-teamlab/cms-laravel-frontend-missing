<?php

namespace App\Http\Controllers\Nicho;

use App\Models\Article;
use App\Models\Category;
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
        # TODO: カテゴリーCache実装？
        $all_categories = Category::getAllCategories();
        $col_categories = $all_categories['column_type']['children'];
        $event_area_categories = $all_categories['event']['children']['areas']['children'];
        $all_columns = Utils::getAllColumns(4);
        $all_events = Utils::getAreaEvent();

        $notices = Article::getArticlesByContentJsonValue("notice_n_news","category_notice","17",3);
        
        $datas = [
            'body_id' => 'topGeneral',
            'body_class' => '',
            'general_top_info' => $general_top_info,
            'important_notice' => $important_notice,
            'area_list' => Utils::$area_list,
            'checkbox_lists' => Utils::$checkbox_lists,
            'col_categories' => $col_categories,
            'all_columns' => $all_columns,
            'notices' => $notices,
            'notice_name' => $all_categories["whats_new"]["children"]["notification"]["display_name"],
            'all_events' => $all_events,
            'event_area_categories' => $event_area_categories,
        ];
        return view('general_index', $datas);
    }

}
