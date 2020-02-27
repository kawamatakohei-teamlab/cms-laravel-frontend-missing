<?php


namespace App\Http\Controllers\Nicho;


use App\Models\Article;
use App\Models\Category;

class Utils
{
    public static function getAllStores()
    {
        # TODO: redis周りを対応
        $stores = Article::getArticlesByArticleType('store');
        return $stores;
    }

    public static function getAllColumns($limit=null)
    {
        # TODO: この関数性能が低い
        $columns_articles = [];
        $categories = Category::getAllCategories();
        $col_categories = $categories['column_type']['children'];
        foreach ($col_categories as $col_name => $col_category) {
            $res = Article::getArticlesByContentJsonValue('column', 'category', $col_name,$limit);
            $columns_articles[$col_name] = $res;
        }
        return $columns_articles;
    }

    public static function getAreaEvent($limit=null)
    {
        $all_events = [];
        $categories = Category::getAllCategories();
        $event_classification = $categories['event']['children']['classification']['children'];
        $event_classification_ids = [];
        foreach ($event_classification as $class_name => $c) {
            $event_classification_ids[$c['id']] = $class_name;
        }
        $areas_categories = $categories['event']['children']['areas']['children'];
        $i = 0;
        foreach ($areas_categories as $area_slug => $area_category) {
            $events = Article::getArticlesByContentJsonValue('event', 'area', strval($area_category['id']),$limit);
            foreach ($events as $key => $event) {
                $event->classification = Utils::getCorrectIds($event->classification);
                $icon_htmls = [];
                foreach ($event->classification as $icon_classification) {
                    $icon_classification_name = $event_classification_ids[$icon_classification];
                    $icon_htmls[] = '<i class="c-box-event-01__icon c-box-event-01__icon--icon-' . Utils::$event_icons[$icon_classification_name] . '"></i>';
                }
                $events[$key]->icon_htmls = $icon_htmls;


            }

            $all_events[$area_slug] = $events;
            $i++;
        }

        return $all_events;
    }

    /*
     * CMSのカテゴリリストはゴミが多いので，それを削除して整形した
     * '"17","8"' -> ['17', '8']
     * 良好（1/16）
     */
    public static function getCorrectIds($category_ids) {
        if(is_string($category_ids) && is_array(json_decode($category_ids, true)) && (json_last_error() == JSON_ERROR_NONE)){
            $category_ids = json_decode($category_ids);
            $category_ids = array_diff($category_ids, array(''));
            $category_ids = array_values($category_ids); //indexを詰める
        }
        return $category_ids;
    }

    /*
     * 日付の曜日取得する
     * example:
     *     '2018-01-01 00:00:00' -> '月'
     */
    public static function getDayOfWeek($date){
        $list = ["日", "月", "火", "水", "木", "金", "土"];
        $date = date_create($date);
        $week = (int)$date->format('w');
        return $list[$week];
    }

    /*
     * 記事掲載開始日を変換する
     * example:
     *     '2018-01-01 00:00:00' -> '2018.1.1'
     * まだ使ってない（1/16）
     */
    public static function convertToDotDate($date){
        $date = preg_replace('/(\d+)[-\/](\d+)[-\/](\d+) (\d+):(\d+):?(\d+)/i', '$1.$2.$3', $date);
        return $date;
    }

    function __construct() {
        $date = $this->cache_busting_date;
        $this->rss_url = $this->rss_url . "?date=$date";
    }

    // キャッシュバスティングの日付（リリースの度に変更してください。）
    public static $cache_busting_date = '20200207';

    // IRページのURL
    public static $rss_url = 'http://v4.eir-parts.net/V4Public/eir/3341/ja/announcement/announcement_3.js';

    //例：public static $rss_list_url = [];
    public static $uri_body_ids = [
        '/^\/$/' => 'topGeneral', //一般トップ
        '/\/corporate[\/]*$/' => 'topCompany', //企業トップ

        '/\/info[\/]*$/' => 'noticeList', //お知らせ一覧
        '/\/info\/[a-zA-Z0-9\-_]+/' => 'noticeDetail', //お知らせ詳細
        '/\/corporate\/newsrelease[\/]*$/' => 'newsList', //ニュース一覧
        '/\/corporate\/newsrelease\/[a-zA-Z0-9\-_]+/' => 'noticeDetail', //ニュース詳細
        '/\/corporate\/performance[\/]*$/' => 'storeNum', //数字で見る日本調剤
        '/\/corporate\/profile[\/]*$/' => 'newsList', //会社案内一覧
        '/\/corporate\/profile\/[a-zA-Z0-9\-_]+/' => 'generalTemplate',
        '/\/corporate\/business[\/]*$/' => 'newsList', //事業内容一覧
        '/\/corporate\/business\/[a-zA-Z0-9\-_]+/' => 'generalTemplate',
        '/\/corporate\/recruitment[\/]*$/' => 'newsList', //採用情報
        '/\/corporate\/recruitment\/[a-zA-Z0-9\-_]+/' => 'generalTemplate',

        '/\/pharmacy[\/]*$/' => 'noticeList', //薬局でできること
        '/\/pharmacy\/[a-zA-Z0-9\-_]+/' => 'generalTemplate',
        '/\/service[\/]*$/' => 'noticeList', //便利なサービス
        '/\/service\/[a-zA-Z0-9\-_]+/' => 'generalTemplate',
        '/\/column[\/]*$/' => 'columnList', //コラム一覧
        '/\/column\/[a-zA-Z0-9\-_]+/' => 'columnDetail', //コラム詳細
        '/\/event[\/]*$/' => 'eventList', //イベント

        '/\/security[\/]*$/' => 'generalTemplate', //情報セキュリティポリシー
        '/\/privacy[\/]*$/' => 'generalTemplate', //個人情報保護方針
        '/\/socialpolicy[\/]*$/' => 'generalTemplate', //ソーシャルメディアポリシー
        '/\/actionplan[\/]*$/' => 'generalTemplate', //行動計画
        '/\/terms[\/]*$/' => 'generalTemplate', //利用規約
        '/\/inquiry\/form_7\/tenpo[\/]?$/' => 'helpCenterOther', //お問い合わせ（その他）店舗
        '/\/inquiry[\/]*$/' => 'helpCenter', //よくあるご質問
        '/\/inquiry[\/].*$/' => 'helpCenter', //よくあるご質問


        '/\/tenpo[\/]*$/' => 'searchStore', //店舗一覧
        '/\/tenpo\/[a-zA-Z0-9\-_]+/' => 'storeDetail', //店舗詳細

        //ここは未定
        '/\/en[\/]*$/' => 'topCompanyEnglish', //English TOP
        '/\/en\/news[\/]*$/' => 'newsList', //News Release一覧
        '/\/en\/news\/[a-zA-Z0-9\-_]+/' => 'newsDetail', //News Release詳細
    ];

    // 全ての記事を表示するためのタグ名（ニュースリリース＆お知らせ一覧ページ）
    // ("id", "画面表示用のタグ名", "クエリパラメーター")
    public static $category_4_all_news = array('-1','すべて','all');

    public static $area_category_4_all_events = array('-1','全国','all');

    // デフォルトでの記事表示件数（ニュースリリース＆お知らせ一覧ページ）
    public static $default_page_number = 50;

    // RSSで取得したIR記事に設定するカテゴリーを指定
    public static $category_4_rss = 'IR';

    public static $event_icons = ['health_measurement' => 'meter', 'seminar' => 'seminar', 'consultation' => 'discuss','other' => 'other'];

    // 都道府県リスト
    public static $area_list = [
        '01' => '北海道', '02' => '青森', '03' => '岩手', '04' => '宮城', '05' => '秋田',
        '06' => '山形', '07' => '福島', '08' => '茨城', '09' => '栃木', '10' => '群馬',
        '11' => '埼玉', '12' => '千葉', '13' => '東京', '14' => '神奈川', '15' => '新潟',
        '16' => '富山', '17' => '石川', '18' => '福井', '19' => '山梨', '20' => '長野',
        '21' => '岐阜', '22' => '静岡', '23' => '愛知', '24' => '三重', '25' => '滋賀',
        '26' => '京都', '27' => '大阪', '28' => '兵庫', '29' => '奈良', '30' => '和歌山',
        '31' => '鳥取', '32' => '島根', '33' => '岡山', '34' => '広島', '35' => '山口',
        '36' => '徳島', '37' => '香川', '38' => '愛媛', '39' => '高知', '40' => '福岡',
        '41' => '佐賀', '42' => '長崎', '43' => '熊本', '44' => '大分', '45' => '宮崎',
        '46' => '鹿児島', '47' => '沖縄',
    ];

    //店舗検索チェックボックスリスト
    public static $checkbox_lists = [
        ['name' => 'booth', 'label' => '保険相談ブース併設', 'column' => 'service_insurance'],
        ['name' => 'parking', 'label' => '駐車場', 'column' => 'equipment_parking'],
        ['name' => 'holiday', 'label' => '土日祝日営業', 'column' => 'weekend_n_holidays_store'],
        ['name' => 'measurement', 'label' => '検体測定室（簡易血液検査）あり', 'column' => 'service_measuring'],
        ['name' => 'kids', 'label' => 'キッズスペースあり', 'column' => 'equipment_baby_kids'],
        ['name' => 'nineteen', 'label' => '19時以降も営業', 'column' => 'after_7pm_store'],
        ['name' => 'resident', 'label' => '管理栄養士の常駐', 'column' => 'service_nutrition'],
        ['name' => 'apps', 'label' => 'アプリからの処方箋送信可能', 'column' => 'service_prescription_submit'],
        ['name' => 'health', 'label' => '健康チェックステーション併設店舗', 'column' => 'service_health_check'],
    ];

    // お問い合わせの分類
    public static $inquiry_forms = [
        '1' => '事業内容',
        '2' => 'IR情報について',
        '3' => '採用について',
        '4' => '在宅医療サービスについて',
        '5' => '病院への薬剤師派遣について',
        '6' => '個人情報保護について',
        '7' => 'その他',
    ];

    // お問い合わせのフォームのグループ項目
    public static $inquiry_group_keys = [
        'kanji_lastname' => 'お名前',
        'hiragana_lastname' => 'ふりがな',
        'email' => 'メールアドレス',
    ];

    // デフォルメタタグ
    public static $default_meta_tags =
        [
            'jp' => [
                'corporate' => [
                    'lang' => 'jp',
                    'title_suffix' => '日本調剤（企業情報）',
                    'title' => '日本調剤（企業情報）',
                    'description' => '全国で調剤薬局を展開する「日本調剤」の企業情報サイト。ニュースリリース、会社案内、事業内容、IR、採用に関する最新情報を掲載。',
                    'ogp_image' => '/assets/materials/ogp_corporate.png',
                    'ogp_site_name' => '日本調剤',
                ],
                'general' => [
                    'lang' => 'jp',
                    'title_suffix' => '日本調剤（お客さま向け情報）',
                    'title' => '日本調剤（お客さま向け情報）',
                    'description' => '全国で調剤薬局を展開する「日本調剤」のウェブサイト。店舗検索や企業情報、サービス案内のほか、お薬や健康に役立つ情報もご案内しています。',
                    'ogp_image' => '/assets/materials/ogp_general.png',
                    'ogp_site_name' => '日本調剤',
                ]
            ],
            'en' => [
                'lang' => 'en',
                'title_suffix' => 'NIHON CHOUZAI',
                'title' => 'NIHON CHOUZAI',
                'description' => '',
                'ogp_image' => '/assets/materials/ogp_english.png',
                'ogp_site_name' => 'NIHON CHOUZAI',
            ],
        ];

    // ラボサーチAPIのURL
    public static $search_url =
        [
            'development' => 'https://stg-nihonchouzai-search.team-rec.jp/select',
            'staging' => 'https://stg-nihonchouzai-search.team-rec.jp/select',
            'production' => 'https://nihonchouzai-search.team-rec.jp/select',
        ];

    // 会社案内の文言
    // テキストの文言はまだ決まっていないので、仮置き 3/1
    public static $company_brochures = [
        'jp' => [
            'main'=>['title' => '会社案内', 'text' => ''],
            'contents' =>[
                ['button_text' => '企業理念', 'button_link' => '/corporate/profile/philosophy', 'image' => '/assets/materials/img_companyinfo_01.png'],
                ['button_text' => 'トップメッセージ', 'button_link' => '/corporate/profile/topmessage', 'image' => '/assets/materials/img_companyinfo_02.png'],
                ['button_text' => '会社概要', 'button_link' => '/corporate/profile/about', 'image' => '/assets/materials/img_companyinfo_03.png'],
                ['button_text' => '沿革', 'button_link' => '/corporate/profile/history', 'image' => '/assets/materials/img_companyinfo_04.png'],
                ['button_text' => '役員一覧', 'button_link' => '/corporate/profile/officer', 'image' => '/assets/materials/img_companyinfo_05.png'],
                ['button_text' => '支店・営業所', 'button_link' => '/corporate/profile/office', 'image' => '/assets/materials/img_companyinfo_06.png'],
                ['button_text' => '日本調剤グループ', 'button_link' => '/corporate/profile/group', 'image' => '/assets/materials/img_companyinfo_07.png'],
                ['button_text' => '日本調剤の社会貢献活動', 'button_link' => '/corporate/profile/contribution', 'image' => '/assets/materials/img_companyinfo_08.png'],
            ]
        ],
        'en' => [
            'main'=>['title' => 'Company Brochure', 'text' => ''],
            'contents' =>[
                ['button_text' => 'Corporate Philosophy', 'button_link' => '/en/profile/philosophy', 'image' => '/assets/materials/img_companyinfo_01.png'],
                ['button_text' => 'Message from the President', 'button_link' => '/en/profile/topmessage', 'image' => '/assets/materials/img_companyinfo_02.png'],
                ['button_text' => 'Company Profile', 'button_link' => '/en/profile/about', 'image' => '/assets/materials/img_companyinfo_03.png'],
                ['button_text' => 'History', 'button_link' => '/en/profile/history', 'image' => '/assets/materials/img_companyinfo_04.png'],
                ['button_text' => 'Board of Directors', 'button_link' => '/en/profile/officer', 'image' => '/assets/materials/img_companyinfo_05.png'],
                ['button_text' => 'Branches', 'button_link' => '/en/profile/office', 'image' => '/assets/materials/img_companyinfo_06.png'],
                ['button_text' => 'Nihon Chouzai Group', 'button_link' => '/en/profile/group', 'image' => '/assets/materials/img_companyinfo_07.png'],
                ['button_text' => 'Social Contribution Activities', 'button_link' => '/en/profile/contribution', 'image' => '/assets/materials/img_companyinfo_08.png'],
            ]
        ],
    ];

    // Redisにデータをキャッシュするの設定
    public static $redis_cache_config = [
        'allStores' => [
            'key' => 'allStores',
            'expired' => 60 * 60 * 24, //1日
        ],
        'stores' => [
            'expired' => 60 * 60 * 24, //1日
        ],
    ];

    //GoogleMapのピン画像
    public $map_pin = '/assets/materials/map-pin.png';

    public $company_side_tags_path = array('/corporate/', '/security/', '/privacy/', '/socialpolicy/', '/actionplan/', '/terms/');

    public $event_report_link = '/column/?category=EVENT_REPORT';

}
