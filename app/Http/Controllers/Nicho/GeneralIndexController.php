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
        return view('pages/general_index', $datas);
    }

    public function notice($permalink,Request $request) {
        // $request_uri = $request->path();
        //「ニュースリリース」か「お知らせ」かを判定
        // $is_news_release;
        // if(preg_match('/admin.*preview.*/', $request_uri)){
        //     //バックエンドの「プレビュー」
        //     $is_news_release = strpos($request_uri, 'news');
        // }
        // else {
        //     //フロントエンド
        //     $is_news_release = strpos($request_uri, 'corporate/newsrelease');
        // }
        // $category_id = $is_news_release ? $item->category_news : $item->category_notice;
        $notice = Article::getArticlesByArticleTypeAndPermalink('info',$permalink);
        $notice_contents = json_decode($notice->contents);
        // dd($notice);
        $category = Category::getCategoriesById($notice_contents->category_notice);
        $publish_at = Utils::convertToDotDate($notice->publish_at);
        $day_of_week = Utils::getDayOfWeek($notice->publish_at);
        $request_url = $request->url();
        if(strpos($request_url, 'corporate/newsrelease') !== false){
            $path = '/corporate/newsrelease/';
        }else{
            $path = '/info/';
        }
        $articles = Article::getArticlesByArticleTypeAndPublicAt($notice->article_type,'<=',$notice->publish_at);
        $next_article = null;
        foreach($articles as $index => $article){
            if($article->id == $notice->id){
                if(isset($articles[$index + 1])){
                    $next_article = $articles[$index + 1];
                    break;
                }
            }
        }
        if($next_article){
            $next_article_uri = $path . $next_article->permalink;
        } else {
            $next_article_uri = false;
        }
        $datas = [
            'title' => $notice->title,
            'publish_at' => $publish_at,
            'category_name' => $category->name,
            'day_of_week' => $day_of_week,
            'next_article_uri' => $next_article_uri,
        ];
        return view('pages/notice_detail', $datas);
    }

}
