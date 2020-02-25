<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>日本調剤（お客さま向け情報）</title>
    <meta name="description" content="全国で調剤薬局を展開する「日本調剤」のウェブサイト。店舗検索や企業情報、サービス案内のほか、お薬や健康に役立つ情報もご案内しています。">
    <meta property="og:title" content="日本調剤（お客さま向け情報）">
    <meta property="og:description" content="全国で調剤薬局を展開する「日本調剤」のウェブサイト。店舗検索や企業情報、サービス案内のほか、お薬や健康に役立つ情報もご案内しています。">
    <meta property="og:url" content="http://localhost/">
    <meta property="og:image" content="http:/localhost/assets/materials/ogp_general.png">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="日本調剤">
    <link rel="shortcut icon"  href="/favicon32px.ico?date=20190725" sizes="32x32">
    <link rel="shortcut icon"  href="/favicon48px.ico?date=20190725" sizes="48x48">
    <link rel="shortcut icon"  href="/favicon64px.ico?date=20190725" sizes="64x64">
    <link rel="shortcut icon"  href="/favicon128px.ico?date=20190725" sizes="128x128">
    <link rel="stylesheet" href="/assets/styles/style.css?date=20190725">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PS4768');</script>
    <!-- End Google Tag Manager -->
</head>
<body id="{{ $body_id }}"{{$body_class}}>
<?php
$logo_tag = 'div';
if(Request::url() ==  '/'){
    $logo_tag = 'h1';
}
?>
<header class="c-header c-header--bg-white">
    <div class="c-header__in">
        <div class="c-header__upper">
            <{{$logo_tag}} class="c-header__logo"><a class="c-header__logo-link" href="/"><img class="c-header__logo-img" src="/assets/materials/logo.png" alt="日本調剤"/></a><span class="c-header__logo-text">お客さま向け情報</span>
        </{{$logo_tag}}>
        <div class="c-header__menu-sp">
            <div class="c-header__button-search"></div>
            <div class="c-header__button-menu"><span class="c-header__button-menu__item"></span><span class="c-header__button-menu__item"></span><span class="c-header__button-menu__item"></span><span class="c-header__button-menu__item"></span></div>
        </div>
    </div>
    <div class="c-header__lower">
        <div class="c-header__nav-container">
            <nav class="c-nav-global">
                <ul class="c-nav-global__list">
                    <li class="c-nav-global__list-item"><a class="c-nav-global__link" href="/tenpo">店舗検索</a></li>
                    <li class="c-nav-global__list-item"><a class="c-nav-global__link" href="/pharmacy">薬局でできること</a></li>
                    <li class="c-nav-global__list-item"><a class="c-nav-global__link" href="/service">便利なサービス</a></li>
                    <li class="c-nav-global__list-item"><a class="c-nav-global__link" href="/column">お役立ちコラム</a></li>
                    <li class="c-nav-global__list-item"><a class="c-nav-global__link" href="/info">お知らせ</a></li>
                    <li class="c-nav-global__list-item"><a class="c-nav-global__link" href="/event">イベント</a></li>
                    <li class="c-nav-global__list-item"><a class="c-nav-global__link" href="/inquiry#inquiry">お問い合わせ</a></li>
                </ul>
            </nav>
            <div class="c-header-utility"><a class="c-header-utility__button-link" href="/corporate"><span class="c-header-utility__button-text">企業情報<span class='c-header-utility__button-text-sp'>ページ</span></span></a><a class="c-header-utility__button-link c-header-utility__button-link--bg-white" href="/en"><span class="c-header-utility__button-text">English</span></a>
                <div class="c-header-font">
                    <p class="c-header-font__text">文字</p>
                    <ul class="c-header-font__list">
                        <li class="c-header-font__list-item"><span class="c-header-font__link" data-font="normal">あ</span></li>
                        <li class="c-header-font__list-item"><span class="c-header-font__link c-header-font__link--large" data-font="large">あ</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="c-header-search">
            <div class="c-header-search__in">
                <form action="/search" method="GET">
                    <input class="c-header-search__input js-search-autocomplete" type="text" name="word" placeholder="検索" value="" autocomplete="off"/>
                    <input type="hidden" type="text" name="referer" value="general"/>
                    <ul class="c-header-search__autocomplete">
                    </ul>
                    <button class="c-header-search__button"></button>
                </form>
            </div>
        </div>
    </div>
    </div>
</header>
<main class="c-main">
    <div class="c-hero">
        <div class="c-hero__in">
            <div class="c-hero__slider">
                @for ($i = 1; $i <= 5; $i++)
                    @if (!empty($general_top_info["main_image_pc_$i"]) ||  !empty($general_top_info["main_image_sp_$i"]))
                        <div class="c-hero__item">
                            <div class="c-hero__image" data-pc-image="{{ route('assets.image',['thumb_size'=>'original','name'=>$general_top_info["main_image_pc_$i"]]) }}" data-sp-image="{{ route('assets.image',['thumb_size'=>'original','name'=>$general_top_info["main_image_sp_$i"]]) }}">
                                <div class="c-hero__info">
                                    <div class="c-hero__info-in">
                                        <div class="c-hero__title-wrap">
                                            @if (!empty($general_top_info["title_$i"]))
                                            <p class="c-hero__title">{{$general_top_info["title_$i"]}}</p>
                                            @endif
                                            @if (!empty($general_top_info["caption_$i"]))
                                            <p class="c-hero__text">{{$general_top_info["caption_$i"] }}</p>
                                            @endif
                                        </div>
                                        @if (!empty($general_top_info["transform_url_$i"]) ||  !empty($general_top_info["button_text$i"]))
                                        <a class="c-button c-hero__button" href="{{ $general_top_info["transform_url_$i"]}}" >
                                            <span class="c-button__text c-button__icon c-button__icon--icon-arrow">{{ $general_top_info["button_text_$i"] }}</span>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endfor
            </div>
        </div>
    </div>

    <div class="c-hero-news">
        <div class="c-hero-news__in">
            <div class="c-hero-news__item">
                <div class="c-hero-news__date">{{ $important_notice->updated_at }}（NEED TO COMPLETE WEEK FUNCTION）<span class="c-hero-news__pipe">|</span><br class="only-sp"> {{ $important_notice->title }}</div>
                <div class="c-hero-news__detail"><a class="c-hero-news__link" href="{{ $important_notice->transform_url }}">{{ $important_notice->contents['description'] }}</a></div>
            </div>
        </div>
    </div>

    {{--店舗検索部分--}}
    <section class="c-section c-section--bg-gray only-pc">
        <h2 class="c-title">店舗検索</h2>
        <div class="section-search-store__in">
            <div class="c-search-store">
                <form method="GET" action="/tenpo">
                    <div class="c-search-store__form">
                        <div class="c-select-area js-custom-pulldown c-search-store__form-area">
                            <div class="c-select-area__text" data-text="">エリア</div>
                            <input class="c-select-area__input" data-input="" type="hidden" value="" name="area"/>
                            <div class="c-select-area__list" data-pulldown="">
                                @foreach($area_list as $code=>$name)
                                <div class="c-select-area__item" data-value="{{ $code }}">{{ $name }}</div>
                                @endforeach
                            </div>
                        </div>
                        <input class="c-search-store__form-keyword" type="text" value="" placeholder="キーワード" name="keyword">
                        <button class="c-search-store__form-button"></button>
                    </div>
                    <div class="c-search-filter">
                        <div class="c-search-filter__condition">
                            <a class="c-search-filter__condition-link" href="javascript:void(0);">その他条件で検索</a>
                        </div>
                        <div class="c-search-filter__modal">
                            <div class="c-search-filter__modal-in">
                                <div class="c-search-filter__option">
                                    @foreach( $checkbox_lists as $checkbox_list)
                                    <div class="c-search-filter__option-item">
                                        <label class="c-checkbox">
                                            <input class="c-checkbox__input" type="checkbox" name="{{ $checkbox_list['name'] }}" />
                                            <span class="c-checkbox__text">{{ $checkbox_list['label'] }}</span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="c-search-filter__modal-button">
                                    <a class="c-button c-button--size-small c-button--is-block c-search-filter__button-submit" href="#">
                                        <span class="c-button__text">決定</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    {{--    これはスマホ向けの部分なので、とりあえずいらない--}}
{{--    <section class="c-section c-section--no-padding-bottom only-sp">--}}
{{--        <div class="c-section__in">--}}
{{--            <h2 class="c-title">お近くの店舗</h2>--}}
{{--            <div class="l-row-content">--}}
{{--                <div class="c-nearby-search js-sp-search">--}}
{{--                    <div class="c-nearby-search__text">位置情報の使用許可がされませんでした。<br>位置情報をオンにするとお近くの店舗が表示されます。</div>--}}
{{--                    <div class="c-search-store">--}}
{{--                        <form method="GET" action="/tenpo">--}}
{{--                            <div class="c-search-store__form">--}}
{{--                                <div class="c-select-area js-custom-pulldown c-search-store__form-area">--}}
{{--                                    <div class="c-select-area__text" data-text="">エリア</div>--}}
{{--                                    <input class="c-select-area__input" data-input="" type="hidden" value="" name="area"/>--}}
{{--                                    <div class="c-select-area__list" data-pulldown="">--}}
{{--                                        {% for code, name in area_list %}--}}
{{--                                        <div class="c-select-area__item" data-value="{{ code }}">{{ name }}</div>--}}
{{--                                        {% endfor %}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <input class="c-search-store__form-keyword" type="text" value="" placeholder="キーワード" name="keyword">--}}
{{--                                <button class="c-search-store__form-button"></button>--}}
{{--                            </div>--}}
{{--                            <div class="c-search-filter">--}}
{{--                                <div class="c-search-filter__modal">--}}
{{--                                    <div class="c-search-filter__modal-in">--}}
{{--                                        <div class="c-search-filter__option">--}}
{{--                                            <div class="c-search-filter__option-item">--}}
{{--                                                {% for checkbox_list in checkbox_lists %}--}}
{{--                                                <label class="c-checkbox">--}}
{{--                                                    <input class="c-checkbox__input" type="checkbox" name="{{ checkbox_list['name'] }}"/>--}}
{{--                                                    <span class="c-checkbox__text">{{ checkbox_list['label'] }}</span>--}}
{{--                                                </label>--}}
{{--                                                {% endfor %}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="c-search-filter__modal-button">--}}
{{--                                            <a class="c-button c-button--size-small c-button--is-block c-search-filter__button-submit" href="#">--}}
{{--                                                <span class="c-button__text">決定</span>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="c-nearby-map js-sp-map">--}}
{{--                    <div class="c-nearby-map__map js-google-map" data-pin-image="{{ nd.map_pin }}"></div>--}}
{{--                    <a class="c-nearby-map__google-button js-google-map-link" href="" target="_blank">地図を開く</a>--}}
{{--                    <div class="c-nearby-map__info">--}}
{{--                        <ul class="js-map-info-list">--}}
{{--                            {% for store in stores %}--}}
{{--                            <li class="js-map-info-item">--}}
{{--                                <a class="c-card-map-info js-map-info" href="/tenpo/{{ store.permalink }}" data-lat="{{ store.map_latitude }}" data-lng="{{ store.map_longitude }}" data-google-map-link="https://www.google.com/maps?q={{ store.map_latitude }},{{ store.map_longitude }}">--}}
{{--                                    <div class="c-card-map-info__title-wrap">--}}
{{--                                        <div class="c-card-map-info__title js-title">{{ store.title }}</div>--}}
{{--                                        <div class="c-card-map-info__range js-distance"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="c-card-map-info__open-time">営業時間：{{ store.opening_hours }}</div>--}}
{{--                                    <div class="c-card-map-info__open-date">定休日：{{ store.regular_holiday }}</div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            {% endfor %}--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="l-center js-sp-button">--}}
{{--                <a class="c-button" href="/tenpo">--}}
{{--                    <span class="c-button__text c-button__icon c-button__icon--icon-arrow">他の店舗を探す</span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}


</main>
</body>
</html>
