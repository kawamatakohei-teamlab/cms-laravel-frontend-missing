@extends('layouts.common')

@section('main')

<?php
$contents = json_decode($infoArticle->contents);
$infoCategory = $infoCategories->first(function ($infoCategory) use ($contents){
    return $infoCategory->id == $contents->notice_type[0];
});
$infoCategoryName = $infoCategory ? $infoCategory->name : 'ALL';
?>

<div class="layout-base__inner layout-base__inner--column">
    <main class="layout-base__main">
        <div class="js-scroll animation-slide-in-bottom">
            <div class="info-header">
                <div class="info-header__heading">Information</div>
                <div class="info-header__category">
                    <span class="info-header__category-text">{{$infoCategoryName}}</span>
                </div>
                <h1 class="info-header__title">
                    {{ $infoArticle->title }}
                </h1>
                <div class="info-header__date">
                    {{ $infoArticle->publish_at->format('Y.m.d') }}
                </div>
            </div>
        </div>

        <?php
        $dynamicTypeKeys = [
            'single_body',
            'single_body_background_on', // HACK: backend側で未実装？ 要確認
            'notice_image',
            'notice_youtube',
            'notice_pdf'
        ]
        ?>
        {{-- dynamic parts類表示 --}}
        @foreach ($contents->dynamic as $dynamic)
            @foreach ($dynamicTypeKeys as $dynamicTypeKey)
                @if (property_exists($dynamic, $dynamicTypeKey ))
                    @includeIf('parts.dynamic.' . $dynamicTypeKey, ['dynamicContents' => $dynamic])
                @endif
            @endforeach
        @endforeach

        <div class="js-scroll animation-slide-in-bottom">
            <div class="page-navi">
                <div class="page-navi__inner"><a class="page-navi__block" href="">
                    <div class="page-navi__text">
                        <div class="page-navi__name">前の記事</div>
                        <div class="page-navi__title"><span>タイトルタイトル</span></div>
                    </div>
                    <div class="page-navi__image"><img class="page-navi__image-img" src="http://placehold.jp/100x200.png" alt=""></div></a><a class="page-navi__block" href="">
                    <div class="page-navi__text">
                        <div class="page-navi__name">次の記事</div>
                        <div class="page-navi__title"><span>タイトルタイトルタイトルタイトル</span></div>
                    </div>
                <div class="page-navi__image"><img class="page-navi__image-img" src="http://placehold.jp/50x50.png" alt=""></div></a></div>
            </div>
        </div>
    </main>





    {{-- Sidebar --}}
    <aside class="layout-base__side">
        <div class="js-scroll animation-slide-in-bottom">
            <div class="side-list">
                <div class="side-list__title">
                    <strong>芸術活動 教員</strong>の新着
                </div>
                <div class="side-list__list">
                    <ul class="side-link-list">
                        <li class="side-link-list__item"><a class="side-link-list__wrap" href="">
                            <div class="side-link-list__title"><span>Both Sides,Now 中西學・菅原一剛展</span></div>
                            <div class="side-link-list__image"><img class="side-link-list__image-img" src="http://placehold.jp/30x30.png" alt=""></div></a>
                        </li>
                        <li class="side-link-list__item"><a class="side-link-list__wrap" href="">
                            <div class="side-link-list__title"><span>林康夫 陶展 ～五条坂より～</span></div>
                            <div class="side-link-list__image"><img class="side-link-list__image-img" src="http://placehold.jp/200x100.png" alt=""></div></a>
                        </li>
                        <li class="side-link-list__item"><a class="side-link-list__wrap" href="">
                            <div class="side-link-list__title"><span>田嶋悦子　花咲きぬ</span></div>
                            <div class="side-link-list__image"><img class="side-link-list__image-img" src="http://placehold.jp/100x200.png" alt=""></div></a>
                        </li>
                        <li class="side-link-list__item"><a class="side-link-list__wrap" href="">
                            <div class="side-link-list__title"><span>堀内充 BALLET COLLECTION 2019</span></div>
                            <div class="side-link-list__image"><img class="side-link-list__image-img" src="http://placehold.jp/60x60.png" alt=""></div></a>
                        </li>
                    </ul>
                </div>
                <div class="side-list__link">
                    <!-- mixinを定義-->
                    <div class="link-more">
                        <a class="link-more__link" href="">一覧を見る</a>
                    </div>
                </div>
            </div>

            @include('parts.twitter')
        </div>
    </aside>
</div>
@endsection
