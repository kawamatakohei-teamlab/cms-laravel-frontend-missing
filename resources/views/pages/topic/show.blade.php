@extends('layouts.common')

@section('breadcrumb', Breadcrumbs::render('topicShow', $topicArticle))

@section('main')
<main class="layout-base__main-center">
    <div class="layout-base__inner">
        <header class="visual-header js-scroll">
            <div class="visual-header__block">
                <div class="visual-header__heading">
                    <div class="visual-header__subtitle">
                        {{-- TODO: 表示するタグ？カテゴリー？学科？は１つでいいか確認 category --}}
                        <span class="visual-header__subtitle-text">
                            Topics
                        </span>
                    </div>
                    <h1 class="visual-header__title">
                        <span class="visual-header__title-text">
                            {!! $topicArticle->title !!}
                        </span>
                    </h1>
                </div>
                <div class="visual-header__visual visual-header__visual--large">
                    <img class="visual-header__visual-image" src="{{ imageUrlById($topicArticle->main_image) }}" alt="">
                </div>
            </div>
        </header>

        <div class="layout-base__container">
            <div class="js-scroll animation-slide-in-bottom">
                <div class="article-classification">
                    <div class="article-classification__tag">
                        <ul class="tag-list">
                            {{-- TODO: ここはジャンル？ genres --}}
                            <li class="tag-list__item"><span class="tag">イベント</span></li>
                            <li class="tag-list__item"><span class="tag">イベント</span></li>
                        </ul>
                    </div>
                    <div class="article-classification__date">
                        {{ $topicArticle->publish_at->format('Y/m/d') }}
                    </div>
                </div>
            </div>

            <?php
            // TODO: ここは別の箇所で定数として固めるべきかもしれない。考えておく。
            $dynamicTypeKeys = [
                'overview_frame', // 概要_枠付き
                'middle_heading', // 中見出し
                'single_body', // 本文
                'three_images', // 画像３枚
                'image_description', // 画像と本文
                'single_image', // 画像
                'single_movie', // 動画
                'topics_text', // Topicsテキスト
                'message', // メッセージ
                'underline_headline_28px', // 下線中見出し
                'nine_images', //画像21枚
            ]
            ?>
            @foreach ($topicArticle->dynamic as $dynamic)
                @foreach ($dynamicTypeKeys as $dynamicTypeKey)
                    @if (property_exists($dynamic, $dynamicTypeKey))
                        <div class="js-scroll animation-slide-in-bottom">
                            @includeIf('partials.dynamic.topic.' . $dynamicTypeKey, [
                                'dynamicContents' => $dynamic,
                            ])
                        </div>
                    @endif
                @endforeach
            @endforeach

            @yield('topic_show_nine_images_gallery')
        </div>
    </div>
</main>



{{-- TODO: どういう表示ロジックのリコメンドにするのか確認 --}}
{{-- リコメンド --}}
<aside class="layout-base__main-center layout-base__main-center--black">
    <div class="layout-base__inner">
        <!-- mixinを定義-->
        <h2 class="heading-large heading-large--low js-scroll">
            <div class="heading-large__wrap">
                <div class="heading-large__text">関連するTopics</div>
            </div>
        </h2>
        <div class="js-scroll animation-slide-in-bottom">
            <div class="thumbnail-list thumbnail-list--sp-cols2">
                <ul class="thumbnail-list__list">
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">プロジェクト</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/254x150.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>紫舟先生注目の講義</span></div>
                            <div class="thumbnail-list__text">書を通じて文字の美しさを再確認する。</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/1000x150.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>ART OSAKA 2019</span></div>
                            <div class="thumbnail-list__text">大阪都心のホテルで作品を展示、そして販売まで</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/254x1000.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>大阪芸術大学+カリフォルニア美術大学 交流版画展</span></div>
                            <div class="thumbnail-list__text">日米の学生が版画を通じて交流。その先に見えるものは？</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/150x150.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>「美術家の登竜門」で卒業生が快挙！</span></div>
                            <div class="thumbnail-list__text">800点を超える応募作品から、2015年度卒業の綾理恵さんが入選しました！</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/500x500.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>トーベ・ヤンソン展開催記念 高校生版画セミナー</span></div>
                            <div class="thumbnail-list__text">トーベ・ヤンソンの世界から受けたインスピレーションを版画で表現</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/254x150.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>第6回大阪芸術大学Art lab. 大阪芸術大学グループ特別美術セミナー</span></div>
                            <div class="thumbnail-list__text">高校生に大好評のアートセミナー 2019年は天才ピカソに挑戦！</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/254x150.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>韓国アートフェア</span></div>
                            <div class="thumbnail-list__text">プロと同じフィールドで勝負！アジア最大規模のアートフェアに出展</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- mixinを定義-->
        <h2 class="heading-large heading-large--low js-scroll">
            <div class="heading-large__wrap">
                <div class="heading-large__text">同じ学科のTopics</div>
            </div>
        </h2>
        <div class="js-scroll animation-slide-in-bottom">
            <div class="thumbnail-list thumbnail-list--sp-cols2">
                <ul class="thumbnail-list__list">
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">プロジェクト</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/254x150.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>紫舟先生注目の講義</span></div>
                            <div class="thumbnail-list__text">書を通じて文字の美しさを再確認する。</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/1000x150.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>ART OSAKA 2019</span></div>
                            <div class="thumbnail-list__text">大阪都心のホテルで作品を展示、そして販売まで</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/254x1000.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>大阪芸術大学+カリフォルニア美術大学 交流版画展</span></div>
                            <div class="thumbnail-list__text">日米の学生が版画を通じて交流。その先に見えるものは？</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/150x150.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>「美術家の登竜門」で卒業生が快挙！</span></div>
                            <div class="thumbnail-list__text">800点を超える応募作品から、2015年度卒業の綾理恵さんが入選しました！</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/500x500.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>トーベ・ヤンソン展開催記念 高校生版画セミナー</span></div>
                            <div class="thumbnail-list__text">トーベ・ヤンソンの世界から受けたインスピレーションを版画で表現</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/254x150.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>第6回大阪芸術大学Art lab. 大阪芸術大学グループ特別美術セミナー</span></div>
                            <div class="thumbnail-list__text">高校生に大好評のアートセミナー 2019年は天才ピカソに挑戦！</div>
                        </a>
                    </li>
                    <li class="thumbnail-list__item">
                        <a class="thumbnail-list__inner" href="">
                            <div class="thumbnail-list__wrap">
                                <div class="thumbnail-list__category"><span class="thumbnail-list__category-item">イベント</span></div>
                                <div class="thumbnail-list__image"><img src="http://placehold.jp/254x150.png" alt=""></div>
                            </div>
                            <div class="thumbnail-list__title"><span>韓国アートフェア</span></div>
                            <div class="thumbnail-list__text">プロと同じフィールドで勝負！アジア最大規模のアートフェアに出展</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
@endsection
