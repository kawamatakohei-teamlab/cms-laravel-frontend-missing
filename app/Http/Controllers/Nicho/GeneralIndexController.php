<?php

namespace App\Http\Controllers\Nicho;

use App\Models\Article;
use App\Models\Category;
use App\Models\DaisySearch;
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

        //お知らせ
        $notices_object = Article::getArticlesByContentJsonValue("info","category_notice","17",3);
        $notices = [];
        foreach ($notices_object as $index => $notice) {
            $publish_at = Utils::convertToDotDate($notice->publish_at);
            $notices[$index]["title"] = $notice->title;
            $notices[$index]["permalink"] = $notice->permalink;
            $notices[$index]["publish_at"] = $publish_at;
        }
        
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

    //お知らせ(detail)
    public function notice_detail($permalink,Request $request) {
        $notice = Article::getArticlesByArticleTypeAndPermalink('info',$permalink);
        $notice_contents = json_decode($notice->contents);
        $dynamic = json_decode($notice_contents->dynamic);
        $dynamic_body = Utils::formatWysiwyg($dynamic[0]->d_single_body);
        $category = Category::getCategoriesById($notice_contents->category_notice);
        $publish_at = Utils::convertToDotDate($notice->publish_at);
        $day_of_week = Utils::getDayOfWeek($notice->publish_at);
        $request_uri = $request->path();
        if(strpos($request_uri, 'corporate/newsrelease') !== false){
            $path = '/corporate/newsrelease/';

            $category_name = 'ニュースリリース';
            $category_link = '/corporate/newsrelease/';
            $REDIRECT_URL = '/corporate/';
            $REDIRECT_URL_TITLE = '企業情報トップ';
        }else{
            $path = '/info/';

            $category_name = 'お知らせ';
            $category_link = '/info/';
            $REDIRECT_URL = '/';
            $REDIRECT_URL_TITLE = '日本調剤トップ';
        }
        $breadcrumb_list = [[$REDIRECT_URL_TITLE, $REDIRECT_URL],
                        [$category_name, $category_link],
                        [$notice->title,$request_uri]];
        $breadcrumbs = Utils::createBreadcrumb($breadcrumb_list);

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
            'breadcrumbs' => $breadcrumbs,
            'dynamic_body' => $dynamic_body,
        ];
        return view('pages/notice_detail', $datas);
    }

    //お知らせ(list)
    public function notice_list(Request $request) {
        $years = [];
        for($i=0;$i<9;$i++)
        {
            $str = "-".$i." year";
            $years[] = date('Y', strtotime($str));
        }
        $query = $request->query();
        if($query){
            $search_year = $query["year"];
        }else{
            $search_year = $years[0];
        }
        $search_end_year = $search_year + 1;
        $search_start = [ "operator" => '>=' ,
                          "publish_at" => $search_year.'/04/01'];
        $search_end = [ "operator" => '<' ,
                          "publish_at" => $search_end_year.'/04/01'];
        $articles = Article::getArticlesByArticleTypeAndRangePublicAt('info',$search_start,$search_end);
        $notices = [];
        foreach ($articles as $index => $article) {
            $publish_at = Utils::convertToDotDate($article->publish_at);
            $notices[$index]["title"] = $article->title;
            $notices[$index]["publish_at"] = $publish_at;
            $notices[$index]["permalink"] = $article->permalink;
        }
        $category_name = 'お知らせ';
        $category_link = '/info/';
        $REDIRECT_URL = '/';
        $REDIRECT_URL_TITLE = '日本調剤トップ';
        $breadcrumb_list = [[$REDIRECT_URL_TITLE, $REDIRECT_URL],
                        [$category_name, $category_link]];
        $breadcrumbs = Utils::createBreadcrumb($breadcrumb_list);
        $datas = [
            'years' => $years,
            'notices' => $notices,
            'search_year' => $search_year,
            'breadcrumbs' => $breadcrumbs,
        ];

        $a = new DaisySearch(['type'=>'ec_info','siteCode'=>'001','withinPublication'=>true]);
        $a = $a->setLimit(3)
        ->condition([
            'column' => 'publish_at',
            'operator' => '<',
            'operand' => '2018-11-01 00:00:00',
            ])
        ->search();
        dd($a);

        return view('pages/notice_list',$datas);
    }
}
