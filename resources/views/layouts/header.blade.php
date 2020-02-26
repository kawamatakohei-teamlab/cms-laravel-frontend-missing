@section('header')
<?php
$logo_tag = 'div';
if(Request::url() ==  '/'){
    $logo_tag = 'h1';
}
?>
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
@endsection