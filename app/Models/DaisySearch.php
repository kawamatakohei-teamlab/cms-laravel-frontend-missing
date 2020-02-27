<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DaisySearch extends Model
{
    protected $table = 'search_view_article';

    // コンストラクタに渡される$paramsの値
    private $type = ''; //記事タイプ
    private $langCode = ''; // 言語コード
    private $siteCode = ''; // サイトコード
    private $withinPublication = true;  // 掲載期間内のもののみ返すフラグ
    private $limit;    // 1ベージに表示する数（setLimitでもset可）
    private $page = 1;    // ページ番号（setCurrentPageでもset可）
    private $useStore = false;  //　店舗機能を考慮するか（trueにするとjoinが増える）
    private $publishedOnly = true;  //公開済みのものだけ検索するか（falseにすると全件検索）
    private $includeDynamic = false; //dynamicの値（Json文字列）を返すか

    // Whereするカラム
    private $columns = [];

    public function article()
    {
        return $this->hasMany('App\Models\Article','id','id');
    }


    function __construct($params) {
        if(!isset($params['type'])) abort(404);
        $this->type = $params['type'];
        $this->langCode = isset( $params['langCode'] )? $params['langCode'] : '';
        $this->siteCode = isset( $params['siteCode'] )? $params['siteCode'] : '';
        $this->withinPublication = isset( $params['withinPublication'] ) ? $params['withinPublication'] : true;
        $this->useStore = isset( $params['useStore'] ) ? $params['useStore'] : false;
        $this->publishedOnly = isset( $params['publishedOnly'] ) ? $params['publishedOnly'] : true;
        $this->includeDynamic = isset( $params['includeDynamic'] ) ? $params['includeDynamic'] : false;
     }

    public function search()
    {
        $search_article = DB::table('search_view_article')->join('view_articles', 'search_view_article.id', '=', 'view_articles.id')
        ->where("search_view_article.article_type",$this->type);
        foreach($this->columns as $column)
        {
            $search_article = $search_article->where($column["column"],$column["operator"],$column["operand"]);
        }

        if($this->limit) {
            $search_article = $search_article->limit($this->limit)->get();
        } else {
            $search_article = $search_article->get();
        }
    
        return $search_article;
    }

    //$paramはcolumnとoperatorとoperand
    public function condition($param){
         #なぜか効かない。。エラー処理しないといけない
        // if(!isset($params['column'])) abort(404);
        // if(!isset($params['operator'])) abort(404);
        // if(!isset($params['operand'])) abort(404);
        $this->columns[] = $param;
        return $this;
    }

    public function setLimit($limit) {
        if(!isset($limit)) abort(404);
        $this->limit = (int) $limit;
        return $this;
    }
}
