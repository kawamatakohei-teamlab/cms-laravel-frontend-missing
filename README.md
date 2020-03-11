CMS-laravel-frontend
-------------------------

- [1. CMSv5のLaravelフロントの開発方法](#1-cmsv5%e3%81%aelaravel%e3%83%95%e3%83%ad%e3%83%b3%e3%83%88%e3%81%ae%e9%96%8b%e7%99%ba%e6%96%b9%e6%b3%95)
  - [1.1. あらすじ](#11-%e3%81%82%e3%82%89%e3%81%99%e3%81%98)
  - [1.2. 開発について](#12-%e9%96%8b%e7%99%ba%e3%81%ab%e3%81%a4%e3%81%84%e3%81%a6)
- [2. CMS v4との違い](#2-cms-v4%e3%81%a8%e3%81%ae%e9%81%95%e3%81%84)
  - [2.1. ルーティング( Route ) と コントローラー（ Contaller ) と ビュー（View）](#21-%e3%83%ab%e3%83%bc%e3%83%86%e3%82%a3%e3%83%b3%e3%82%b0-route--%e3%81%a8-%e3%82%b3%e3%83%b3%e3%83%88%e3%83%ad%e3%83%bc%e3%83%a9%e3%83%bc-contaller--%e3%81%a8-%e3%83%93%e3%83%a5%e3%83%bcview)
  - [2.2. 記事テーブルの構造(`view_articles`) と 記事の取得方法](#22-%e8%a8%98%e4%ba%8b%e3%83%86%e3%83%bc%e3%83%96%e3%83%ab%e3%81%ae%e6%a7%8b%e9%80%a0viewarticles-%e3%81%a8-%e8%a8%98%e4%ba%8b%e3%81%ae%e5%8f%96%e5%be%97%e6%96%b9%e6%b3%95)
    - [2.2.1. 記事テーブルの構造](#221-%e8%a8%98%e4%ba%8b%e3%83%86%e3%83%bc%e3%83%96%e3%83%ab%e3%81%ae%e6%a7%8b%e9%80%a0)
    - [2.2.2. 記事の取得方法](#222-%e8%a8%98%e4%ba%8b%e3%81%ae%e5%8f%96%e5%be%97%e6%96%b9%e6%b3%95)
  - [2.3. 記事検索テーブルの構造(search_view_articles) と 記事の検索方法](#23-%e8%a8%98%e4%ba%8b%e6%a4%9c%e7%b4%a2%e3%83%86%e3%83%bc%e3%83%96%e3%83%ab%e3%81%ae%e6%a7%8b%e9%80%a0searchviewarticles-%e3%81%a8-%e8%a8%98%e4%ba%8b%e3%81%ae%e6%a4%9c%e7%b4%a2%e6%96%b9%e6%b3%95)
    - [2.3.1. 記事検索テーブルの構造](#231-%e8%a8%98%e4%ba%8b%e6%a4%9c%e7%b4%a2%e3%83%86%e3%83%bc%e3%83%96%e3%83%ab%e3%81%ae%e6%a7%8b%e9%80%a0)
    - [2.3.2. 記事検索方法](#232-%e8%a8%98%e4%ba%8b%e6%a4%9c%e7%b4%a2%e6%96%b9%e6%b3%95)
  - [2.4. 環境変数](#24-%e7%92%b0%e5%a2%83%e5%a4%89%e6%95%b0)
  - [2.5. 設定に関して( Config )](#25-%e8%a8%ad%e5%ae%9a%e3%81%ab%e9%96%a2%e3%81%97%e3%81%a6-config)
  - [2.6. ログに関して](#26-%e3%83%ad%e3%82%b0%e3%81%ab%e9%96%a2%e3%81%97%e3%81%a6)
  - [2.7. Redisに関して](#27-redis%e3%81%ab%e9%96%a2%e3%81%97%e3%81%a6)
  - [2.8. ユーザー認証ログインなど](#28-%e3%83%a6%e3%83%bc%e3%82%b6%e3%83%bc%e8%aa%8d%e8%a8%bc%e3%83%ad%e3%82%b0%e3%82%a4%e3%83%b3%e3%81%aa%e3%81%a9)



# 1. CMSv5のLaravelフロントの開発方法

## 1.1. あらすじ
CMSv4まで記事の最新バージョンと歴史バージョンは同じ仕組でDBの `articles` `article_versions` `article_types` `article_contents` などのテーブルに保存されている。

しかし、ここで一つ問題がる。フロントはほとんど記事の最新バージョンしか表示しないので、記事の最新バージョンを取得するため、 記事の歴史バージョンから記事の最新バージョンを抽出しないといけない。それ以外の記事操作を含むと、記事の検索はかなり遅い。

検索機能を高速化にするため、CMS v5では新しい viewテーブル が作られた。そのテーブルは記事の最新バージョンしか保存していないので、フロント開発の時、viewテーブルを参照するだけで簡単に記事を取得できる。

>  詳しいviewテーブルの 説明： [CMSの検索機能の高速化を図った件](https://docs.google.com/document/d/1O8OOBnjPNz5zZOEAKDmRdwQRH_49MpmvGXmnbCpsUUA/edit)

また、CMS v4までのフロント開発はほとんど `Phalcon` のテンプレートエンジン `volt` で行って、大量な業務ロジックを `volt` の中に入れた。 そのため、フロントの開発はかなり効率低下だった。

これらの問題を解決しようと思って、CMSv5に遷移するとともに、 フレームワーク `Laravel` でCMSのフロントを作り直した。

## 1.2. 開発について

1. ルーティング
   
   設定は `/route/web.php`
   
   詳細は下の [2.1. ルーティング( Route ) と コントローラー（ Contaller ) と ビュー（View）](#21-%e3%83%ab%e3%83%bc%e3%83%86%e3%82%a3%e3%83%b3%e3%82%b0-route--%e3%81%a8-%e3%82%b3%e3%83%b3%e3%83%88%e3%83%ad%e3%83%bc%e3%83%a9%e3%83%bc-contaller--%e3%81%a8-%e3%83%93%e3%83%a5%e3%83%bcview) を参考
2. コントローラー
   
   各案件のコントローラーは `app/http/Controllers` の下で作る
   
   詳細は下の [2.1. ルーティング( Route ) と コントローラー（ Contaller ) と ビュー（View）](#21-%e3%83%ab%e3%83%bc%e3%83%86%e3%82%a3%e3%83%b3%e3%82%b0-route--%e3%81%a8-%e3%82%b3%e3%83%b3%e3%83%88%e3%83%ad%e3%83%bc%e3%83%a9%e3%83%bc-contaller--%e3%81%a8-%e3%83%93%e3%83%a5%e3%83%bcview) を参考

3. ビュー
   
   ビューの HTML テンプレートは `resourses/views` の下に置く。使ってるのは Laraveの Bladeテンプレートなので、テンプレートファイルの拡張子は `.blade.php`
   
   詳細は下の [2.1. ルーティング( Route ) と コントローラー（ Contaller ) と ビュー（View）](#21-%e3%83%ab%e3%83%bc%e3%83%86%e3%82%a3%e3%83%b3%e3%82%b0-route--%e3%81%a8-%e3%82%b3%e3%83%b3%e3%83%88%e3%83%ad%e3%83%bc%e3%83%a9%e3%83%bc-contaller--%e3%81%a8-%e3%83%93%e3%83%a5%e3%83%bcview) を参考
3. 設定など
   
   全部Laravelに遷移した。各部分は下の記事を参考。

# 2. CMS v4との違い

## 2.1. ルーティング( Route ) と コントローラー（ Contaller ) と ビュー（View）

CMSv4まで、ルーティング( Route ) とビュー（CMSv4では `Voltテンプレート`) はDBに保存されて、ページが呼び出されてる時に、動的に作成してる。 

今回はDBにルーティングとビューとを保存するのをやめて、Laraveのルーティングとコントローラーとビューを使って、正常な MVC フレームワークの使い方に戻した。

- ルーティングを設定したいなら、Laravelのルーティング `route/web.php` を使ったらいい。参照：[ルーティング](https://readouble.com/laravel/6.x/ja/routing.html)

- そして、コントローラーも Laravelのコントローラー `app/http/Controllers` を利用すれば  、参照：[リクエストの取得](https://readouble.com/laravel/6.x/ja/requests.html)

- ビューもそのままLaravelのテンプレートエンジン `blade` を利用すればいい。参照：
  - [ビューの作成](https://readouble.com/laravel/6.x/ja/views.html)
  - [Bladeテンプレート](https://readouble.com/laravel/6.x/ja/blade.html)


## 2.2. 記事テーブルの構造(`view_articles`) と 記事の取得方法
### 2.2.1. 記事テーブルの構造

CMSv5では、すべての記事の最新バージョンは `view_articles` のテーブルに保存されている。下のテーブルはそのテーブルの構造。

下のテーブルを見ると、記事の内容は `json` の文字列として、 テーブルのカラム `contents` に保存されている。

| id | created_at | updated_at | is_published | article_type | site_code | permalink | content_id | article_id | version_id | contents                                                                                                                                                                                                  | status     | title                      | ver_permalink | publish_at | expire_at     | visibility | number | article_language_code |
| -- | ---------- | ---------- | ------------ | ------------ | --------- | --------- | ---------- | ---------- | ---------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- | -------------------------- | ------------- | ---------- | ------------- | ---------- | ------ | --------------------- |
| 1  | 2018/12/25 | 2019/3/26  | 1            | pages        | 1         | top       | 529968     | 1          | 9265       | {"head_title":"headタイトル","meta_description":"meta..." ... | publishing | 記事タイトル | top           | 2018/11/12 | 2100/1/1 0:00 | 0          | 5      | jp                    |

### 2.2.2. 記事の取得方法
もし記事のタイプや記事のIDが分かるなら、CmsCoreにあるモデル `App\CmsCore\Models\Article` あるいは Helper関数 `articleHelper()` で記事を取得できる。使い方：

```php
use App\CmsCore\Models\Article;

# もし記事のIDが分かるなら、直接記事IDを設定して、取得
$query_builder = Article::setArticleId(69);
$article = $query_builder->first();
# 面倒と思うなら、One Lineの方式で書いてもOK。以後のコードは特別な説明を除く、全部この方式で書く
$article = Article::setArticleId(69)->first();


# もし複数の記事IDが分かるなら
$articles = Article::setArticleIds([1,2,3,69])->get();


# 他にの条件の設定や、好きなように組み合わせもできる(記事タイプなど) 詳しい関数一覧は下にある
$articles = Article::setArticleType('pages')->setLangCode('ja')->setPublishedOnly()->get();
# 上の書き方が面倒なら、記事タイプ、言語コード、公開期間を一気に設定する関数もある：
$articles = Article::setArticleInfo('pages', 'ja', true)->get();
```

Helper関数 `articleHelper()` について：

毎回 `App\CmsCore\Models\Article::xxxx()` で記事検索も面倒から、グローバルのHelper関数 `articleHelper()`  を作った。この関数はnamespaceを指定しなくてもそのまま使える。

```php
# articleHelper($article_type = null, $lang_code = null, $can_be_showed = true)
$article = articleHelper('pages', 'ja', true)->get();
```

使える関数：
- `setArticleId( $article_id )` 記事ID指定
- `setArticleIds( $article_ids)` 複数の記事ID指定
- `setPublishedOnly()` この関数を呼び出すと、公開期間内の記事しか返さない（ 公開開始日 <= 現在時間 < 公開終了日 の記事）
- `setLangCode( $lang_code )` 言語コード指定
- `setArticleType( $article_type )` 記事タイプ指定
- `setPermalink( $permalink_name )` 記事のpermalinkを指定
- `setlimit( $limit )` SQL文と同じ意味の limit
- `setArticleInfo($article_type = null, $lang_code = null, $can_be_showed = true)` いちいち記事タイプ、言語コード、公開期間を設定する関数を呼び出すのが面倒から、一気に設定する
- `orderBy('publish_at','desc')` 記事の順番並び
- 他の関数は案件に応じて今後追加予定？
  
*他のSqlに関する関数*

`Article` はLaravelの `Model` classを継承してるから、 Laravelのモデルのすべての関数も使えて、もし案件に必要があれば、これらの関数を呼び出して、そのままSql分を追加構築すればいいです。下は `select()`, `where()` を使った例：

Lravelのモデルが使える関数について：[Laravel データベース：クエリビルダ](https://readouble.com/laravel/6.x/ja/queries.html)

```php
Article::select('id', 'article_type')->setArticleType('page')->get();
Article::setArticleType('page')->where('publish_at','<', '2020-01-01')-get();
```

> 注意：
> 
> Article モデルは記事を取得するためのモデルで、
> 
> もし記事の内容で記事を検索したいなら、下の記事検索の節を見てください


## 2.3. 記事検索テーブルの構造(search_view_articles) と 記事の検索方法
### 2.3.1. 記事検索テーブルの構造

上の節で記事の取得方法について説明したが、次は記事の検索方法について説明する。

記事の内容は `json` の文字列として、 DBのテーブル `view_articles` に保存されているので、記事の内容で記事を検索したい時はかなり難しい。

記事検索を便利にするため、CMSv5では `search_view_article` が存在してる。このテーブルは記事のJSON内容をばらばらにして、保存してる。下のテーブルを見たら分かる：

*記事IDが**1**の記事：*
| id | article_type | content_key      | content_value                                                                                                                          | article_language_code |
| -- | ------------ | ---------------- | -------------------------------------------------------------------------------------------------------------------------------------- | --------------------- |
| 1  | pages        | head_title       | 日本調剤（お客さま向け情報）                                                                                                           | jp                    |
| 1  | pages        | meta_description | 全国で調剤薬局を展開する「日本調剤」のウェブサイト。店舗検索や企業情報、サービス案内のほか、お薬や健康に役立つ情報もご案内しています。 | jp                    |

このテーブルから分かるように、記事の内容は分別でカラム `content_key` `content_value` に保存してる。このテーブルで記事内容で検索することができる

### 2.3.2. 記事検索方法

記事検索はモデル `\App\CmsCore\Models\ArticleSearch` でする。 `ArticleSearch` は `Article` と同じく Laravelの `Model` を継承してるので、使い方は `Article` と似てる感じ：

```php
use \App\CmsCore\Models\ArticleSearch

# まずはsetArticleInfo() を呼び出さないと行けない
# setArticleInfo($article_type, $lang_code, $can_be_showed)

$articles = ArticleSearch::setArticleInfo('pages', 'ja', true)->get();

# 記事の内容 head_title で検索：
$articles = ArticleSearch::setArticleInfo('pages', 'ja', true)->searchContent('head_title','=','日本調剤（お客さま向け情報）')->get();
#複数記事検索条件も追加可。検索条件間の関係は AND
$articles = ArticleSearch::setArticleInfo('pages', 'ja', true)->searchContent('head_title','=','日本調剤（お客さま向け情報）')->searchContent('meta_description','LIKE','%店舗検索や企業情%')->get();
#もし OR の検索関係を追加したいなら、 searchContentOr()を使う
$articles = ArticleSearch::setArticleInfo('pages', 'ja', true)->searchContentOr('head_title','=','日本調剤（お客さま向け情報）')->searchContentOr('meta_description','LIKE','%店舗検索や企業情%')->get();
```
Helper関数 `articleSearchHelper()` について：

毎回 `\App\CmsCore\Models\ArticleSearch::setArticleInfo()` で記事検索も面倒から、グローバルのHelper関数 `articleSearchHelper()`  を作った。この関数はnamespaceを指定しなくてもそのまま使える。

```php
# articleSearchHelper($article_type = null, $lang_code = null, $can_be_showed = true)
$articles = articleSearchHelper('pages', 'ja', true)->searchContent('head_title','=','日本調剤（お客さま向け情報）')->get();
```

使える関数：
- `setArticleInfo($article_type = null, $lang_code = null, $can_be_showed = true)` いちいち記事タイプ、言語コード、公開期間を設定する関数を呼び出すのが面倒から、一気に設定する
- `searchContent($content_key, $operator, $content_value)` 記事内容のkey と value の検索条件を追加。$operator はSql文で使える操作： =, <, >, LIKE など。複数呼び出す可、その時の関係は AND
- `searchContentOr($content_key, $operator, $content_value)` 記事内容のkey と value の検索条件を追加。$operator はSql文で使える操作： =, <, >, LIKE など。複数呼び出す可、その時の関係は AND
- `setLimit($limit)` Sql文と同じ意味のlimit
- 他の関数は案件に応じて今後追加予定？
  
*他のSqlに関する関数*

`Article` はLaravelの `Model` classを継承してるから、 Laravelのモデルのすべての関数も使えて、もし案件に必要があれば、これらの関数を呼び出して、そのままSql分を追加構築すればいいです。下は `orderBy()` を使って、publish_atで順番並びの例：

Lravelのモデルが使える関数について：[Laravel データベース：クエリビルダ](https://readouble.com/laravel/6.x/ja/queries.html)

```php
$articles = ArticleSearch::setArticleInfo('pages', 'ja', true)->orderBy('article.publish_at','desc')->get();
```

## 2.4. 環境変数

環境変数はCMSv4のフロントと違い、 `Laravel` の環境変数システムを使ってる。 詳しい説明はLaravelのドキュメントを参照：https://readouble.com/laravel/6.x/ja/configuration.html

プロジェクトフォルダの下に env ファイルがいくつか存在してる：

 - `.env.local`
 - `.env.dev`
 - `.env.prod`

`.env.local` の中身は local環境の環境変数で、 `.env.dev` は dev環境の環境変数, etc...

環境変数 `APP_ENV` はどのenvファイルを使うのを決める。例えば `APP_ENV` が local の場合、Laravelは `.env.local` を使う。 `APP_ENV` が dev の場合、Laravelは `.env.dev` を使う。

もし新しい環境を追加したいなら、例えばstg環境、新しい `.env.stg` ファイルを作って、 環境変数`APP_ENV`を`stg`にすれば終わる。

## 2.5. 設定に関して( Config )

Laravelの Config を使ってる。`config/settings.php` に設定を追加すれば終わる。使う時に `config('settings.XXXX')` で呼び出せる

## 2.6. ログに関して

ログ周りも Laravel のログを使ってる。Laraveドキュメント参照：https://readouble.com/laravel/6.x/ja/logging.html

使い方が簡単：
```php
Log::info("log info");
Log::error("err info");
```

`config/logging.php` にログの設定がある。 今はDockerを対応するため、ログを stdout に出力してる。もしファイルやメールやslackなどに出力したいなら、上の公式ドキュメントに参照して、このファイルをいじったらOK。

## 2.7. Redisに関して

RedisもLaravelの Redis 機能を使ってる、Redis Clusterも対応してる。

公式ドキュメント参照：https://readouble.com/laravel/6.x/ja/redis.html

## 2.8. ユーザー認証ログインなど

今はしばらくユーザー認証の案件はないので、もしユーザー認証の必要があるなら、 Laravel のユーザー認証機能を使ってください。

参照：https://readouble.com/laravel/6.x/ja/authentication.html

追記：ECと連携も必要かも



