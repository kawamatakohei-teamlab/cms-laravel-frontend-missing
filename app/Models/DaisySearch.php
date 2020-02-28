<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DaisySearch extends Model
{
    protected $table = 'search_view_article';

    // コンストラクタに渡される$paramsの値
    private $type = ''; //記事タイプ
    private $langCode = ''; // 言語コード
    private $siteCode = ''; // サイトコード
    private $withinPublication = true;  // 掲載期間内のもののみ返すフラグ
    private $limit;    // 1ベージに表示する数（setLimitでもset可）
    private $publishedOnly = true;  //公開済みのものだけ検索するか（falseにすると全件検索）
    private $includeDynamic = false; //dynamicの値（Json文字列）を返すか

    // Whereするカラム
    private $columns = [];

    public function article()
    {
        return $this->hasMany('App\Models\Article','id','id');
    }


    function __construct($params) {
        parent::__construct();
        assert( isset( $params['type'] ), new \Exception("type must be set") );
        $this->type = $params['type'];
        $this->langCode = isset( $params['langCode'] )? $params['langCode'] : '';
        $this->siteCode = isset( $params['siteCode'] )? $params['siteCode'] : '';
        $this->withinPublication = isset( $params['withinPublication'] ) ? $params['withinPublication'] : true;
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
        if($this->langCode != '') $search_article = $search_article->where('article_language_code',$this->langCode);
        if($this->siteCode != '') $search_article = $search_article->where('site_code',$this->siteCode);

        if($this->withinPublication){
            $date = new \DateTime();
            $now_date = $date->format('Y-m-d H:i:s');
            $search_article = $search_article->where('publish_at','<=',$now_date)->where('expire_at','>',$now_date);
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
        assert( isset( $param['column'] ), new \Exception("column must be set") );
        assert( isset( $param['operator'] ), new \Exception("operator must be set") );
        assert( isset( $param['operand'] ), new \Exception("operand must be set") );
        Log::info("[DaisySearchModel] condition column:". $param['column']);
        Log::info("[DaisySearchModel] condition operator:". $param['operator']);
        Log::info("[DaisySearchModel] condition operand:". $param['operand']);
        $this->columns[] = $param;
        return $this;
    }

    public function setLimit($limit) {
        assert( isset( $limit ), new \Exception("limit must be set") );
        Log::info("[DaisySearchModel] set limit:". $limit);
        $this->limit = (int) $limit;
        return $this;
    }
}
