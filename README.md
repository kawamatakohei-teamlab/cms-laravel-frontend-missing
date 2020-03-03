CMS-laravel-frontend
-------------------------

- [1. CMSv5のLaravelフロントの開発方法](#1-cmsv5%e3%81%aelaravel%e3%83%95%e3%83%ad%e3%83%b3%e3%83%88%e3%81%ae%e9%96%8b%e7%99%ba%e6%96%b9%e6%b3%95)
  - [1.1. あらすじ](#11-%e3%81%82%e3%82%89%e3%81%99%e3%81%98)
  - [1.2. 開発について](#12-%e9%96%8b%e7%99%ba%e3%81%ab%e3%81%a4%e3%81%84%e3%81%a6)
- [2. CMS v4との違い](#2-cms-v4%e3%81%a8%e3%81%ae%e9%81%95%e3%81%84)
    - [2.0.1. ルーティング( Route ) と コントローラー（ Contaller ) と ビュー（View）](#201-%e3%83%ab%e3%83%bc%e3%83%86%e3%82%a3%e3%83%b3%e3%82%b0-route--%e3%81%a8-%e3%82%b3%e3%83%b3%e3%83%88%e3%83%ad%e3%83%bc%e3%83%a9%e3%83%bc-contaller--%e3%81%a8-%e3%83%93%e3%83%a5%e3%83%bcview)
    - [2.0.2. 記事(Article)取得方法](#202-%e8%a8%98%e4%ba%8barticle%e5%8f%96%e5%be%97%e6%96%b9%e6%b3%95)
    - [2.0.3. 記事検索の方法](#203-%e8%a8%98%e4%ba%8b%e6%a4%9c%e7%b4%a2%e3%81%ae%e6%96%b9%e6%b3%95)
    - [2.0.4. 環境変数](#204-%e7%92%b0%e5%a2%83%e5%a4%89%e6%95%b0)
    - [2.0.5. 設定に関して( Config )](#205-%e8%a8%ad%e5%ae%9a%e3%81%ab%e9%96%a2%e3%81%97%e3%81%a6-config)
    - [2.0.6. ログに関して](#206-%e3%83%ad%e3%82%b0%e3%81%ab%e9%96%a2%e3%81%97%e3%81%a6)
    - [2.0.7. Redisに関して](#207-redis%e3%81%ab%e9%96%a2%e3%81%97%e3%81%a6)
    - [2.0.8. ユーザー認証ログインなど](#208-%e3%83%a6%e3%83%bc%e3%82%b6%e3%83%bc%e8%aa%8d%e8%a8%bc%e3%83%ad%e3%82%b0%e3%82%a4%e3%83%b3%e3%81%aa%e3%81%a9)



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
   
   詳細は下の [2.0.1. ルーティング( Route ) と コントローラー（ Contaller ) と ビュー（View）](#201-%e3%83%ab%e3%83%bc%e3%83%86%e3%82%a3%e3%83%b3%e3%82%b0-route--%e3%81%a8-%e3%82%b3%e3%83%b3%e3%83%88%e3%83%ad%e3%83%bc%e3%83%a9%e3%83%bc-contaller--%e3%81%a8-%e3%83%93%e3%83%a5%e3%83%bcview) を参考
2. コントローラー
   
   各案件のコントローラーは `app/http/Controllers` の下で作る
   
   詳細は下の [2.0.1. ルーティング( Route ) と コントローラー（ Contaller ) と ビュー（View）](#201-%e3%83%ab%e3%83%bc%e3%83%86%e3%82%a3%e3%83%b3%e3%82%b0-route--%e3%81%a8-%e3%82%b3%e3%83%b3%e3%83%88%e3%83%ad%e3%83%bc%e3%83%a9%e3%83%bc-contaller--%e3%81%a8-%e3%83%93%e3%83%a5%e3%83%bcview) を参考

3. ビュー
   
   ビューの HTML テンプレートは `resourses/views` の下に置く。使ってるのは Laraveの Bladeテンプレートなので、テンプレートファイルの拡張子は `.blade.php`
   
   詳細は下の [2.0.1. ルーティング( Route ) と コントローラー（ Contaller ) と ビュー（View）](#201-%e3%83%ab%e3%83%bc%e3%83%86%e3%82%a3%e3%83%b3%e3%82%b0-route--%e3%81%a8-%e3%82%b3%e3%83%b3%e3%83%88%e3%83%ad%e3%83%bc%e3%83%a9%e3%83%bc-contaller--%e3%81%a8-%e3%83%93%e3%83%a5%e3%83%bcview) を参考
3. 設定など
   
   全部Laravelに遷移した。各部分は下の記事を参考。

# 2. CMS v4との違い

### 2.0.1. ルーティング( Route ) と コントローラー（ Contaller ) と ビュー（View）

CMSv4まで、ルーティング( Route ) とビュー（CMSv4では `Voltテンプレート`) はDBに保存されて、ページが呼び出されてる時に、動的に作成してる。 

今回はDBにルーティングとビューとを保存するのをやめて、Laraveのルーティングとコントローラーとビューを使って、正常な MVC フレームワークの使い方に戻した。

- ルーティングを設定したいなら、Laravelのルーティング `route/web.php` を使ったらいい。参照：[ルーティング](https://readouble.com/laravel/6.x/ja/routing.html)

- そして、コントローラーも Laravelのコントローラー `app/http/Controllers` を利用すれば  、参照：[リクエストの取得](https://readouble.com/laravel/6.x/ja/requests.html)

- ビューもそのままLaravelのテンプレートエンジン `blade` を利用すればいい。参照：
  - [ビューの作成](https://readouble.com/laravel/6.x/ja/views.html)
  - [Bladeテンプレート](https://readouble.com/laravel/6.x/ja/blade.html)


### 2.0.2. 記事(Article)取得方法

CMSv5では、すべての記事の最新バージョンは `view_articles` のテーブルに保存されている。記事の `article_type` や `id` が分かるなら、 `view_articles` テーブルから記事を取得できる。

例えば、下の例はとある記事が `view_articles` に保存してる様子。 記事の内容`head_title`, `meta_description` は `json` として、テーブルの `contents` に保存されている


| id | created_at | updated_at | is_published | article_type | site_code | permalink | content_id | article_id | version_id | contents                                                                                                                                                                                                  | status     | title                      | ver_permalink | publish_at | expire_at     | visibility | number | article_language_code |
| -- | ---------- | ---------- | ------------ | ------------ | --------- | --------- | ---------- | ---------- | ---------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------- | -------------------------- | ------------- | ---------- | ------------- | ---------- | ------ | --------------------- |
| 1  | 2018/12/25 | 2019/3/26  | 1            | pages        | 1         | top       | 529968     | 1          | 9265       | {"head_title":"headタイトル","meta_description":"meta..." ... | publishing | 記事タイトル | top           | 2018/11/12 | 2100/1/1 0:00 | 0          | 5      | jp                    |

### 2.0.3. 記事検索の方法

記事検索を便利にするため、CMSv5では `search_view_article` が存在してる。このテーブルは記事の内容を分けて保存してる。下のテーブルはその一例：

記事は上の記事と同じもので、内容 `head_title`, `meate_description` は分けて保存されてる。このテーブルを使ったら、記事を検索できる

| id | article_type | content_key      | content_value                                                                                                                          | article_language_code |
| -- | ------------ | ---------------- | -------------------------------------------------------------------------------------------------------------------------------------- | --------------------- |
| 1  | pages        | head_title       | 日本調剤（お客さま向け情報）                                                                                                           | jp                    |
| 1  | pages        | meta_description | 全国で調剤薬局を展開する「日本調剤」のウェブサイト。店舗検索や企業情報、サービス案内のほか、お薬や健康に役立つ情報もご案内しています。 | jp                    |


### 2.0.4. 環境変数

環境変数はCMSv4のフロントと違い、 `Laravel` の環境変数システムを使ってる。 詳しい説明はLaravelのドキュメントを参照：https://readouble.com/laravel/6.x/ja/configuration.html

プロジェクトフォルダの下に env ファイルがいくつか存在してる：

 - `.env.local`
 - `.env.dev`
 - `.env.prod`

`.env.local` の中身は local環境の環境変数で、 `.env.dev` は dev環境の環境変数, etc...

環境変数 `APP_ENV` はどのenvファイルを使うのを決める。例えば `APP_ENV` が local の場合、Laravelは `.env.local` を使う。 `APP_ENV` が dev の場合、Laravelは `.env.dev` を使う。

もし新しい環境を追加したいなら、例えばstg環境、新しい `.env.stg` ファイルを作って、 環境変数`APP_ENV`を`stg`にすれば終わる。

### 2.0.5. 設定に関して( Config )

Laravelの Config を使ってる。`config/settings.php` に設定を追加すれば終わる。使う時に `config('settings.XXXX')` で呼び出せる

### 2.0.6. ログに関して

ログ周りも Laravel のログを使ってる。Laraveドキュメント参照：https://readouble.com/laravel/6.x/ja/logging.html

使い方が簡単：
```php
Log::info("log info");
Log::error("err info");
```

`config/logging.php` にログの設定がある。 今はDockerを対応するため、ログを stdout に出力してる。もしファイルやメールやslackなどに出力したいなら、上の公式ドキュメントに参照して、このファイルをいじったらOK。

### 2.0.7. Redisに関して

RedisもLaravelの Redis 機能を使ってる、Redis Clusterも対応してる。

公式ドキュメント参照：https://readouble.com/laravel/6.x/ja/redis.html

### 2.0.8. ユーザー認証ログインなど

今はしばらくユーザー認証の案件はないので、もしユーザー認証の必要があるなら、 Laravel のユーザー認証機能を使ってください。

参照：https://readouble.com/laravel/6.x/ja/authentication.html

追記：ECと連携も必要かも



