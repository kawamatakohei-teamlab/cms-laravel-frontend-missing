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
                    @if (!empty($banner_info["main_image_pc_$i"]) ||  !empty($banner_info["main_image_sp_$i"]))
                        <div class="c-hero__item">
                            <div class="c-hero__image" data-pc-image="{{ route('assets.image',['thumb_size'=>'original','name'=>$banner_info["main_image_pc_$i"]]) }}" data-sp-image="{{ route('assets.image',['thumb_size'=>'original','name'=>$banner_info["main_image_sp_$i"]]) }}">
                                <div class="c-hero__info">
                                    <div class="c-hero__info-in">
                                        <div class="c-hero__title-wrap">
                                            @if (!empty($banner_info["title_$i"]))
                                            <p class="c-hero__title">{{$banner_info["title_$i"]}}</p>
                                            @endif
                                            @if (!empty($banner_info["caption_$i"]))
                                            <p class="c-hero__text">{{$banner_info["caption_$i"] }}</p>
                                            @endif
                                        </div>
                                        @if (!empty($banner_info["transform_url_$i"]) ||  !empty($banner_info["button_text$i"]))
                                        <a class="c-button c-hero__button" href="{{ $banner_info["transform_url_$i"]}}" >
                                            <span class="c-button__text c-button__icon c-button__icon--icon-arrow">{{ $banner_info["button_text_$i"] }}</span>
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
</main>
</body>
</html>
