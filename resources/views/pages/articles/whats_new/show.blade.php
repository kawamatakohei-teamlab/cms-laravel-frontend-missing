@extends('layouts.common')

@section('breadcrumb', Breadcrumbs::render('whatsNewShow', $infoArticle))

@section('main')

<div class="layout-base__inner layout-base__inner--column">
    <main class="layout-base__main">
        <div class="js-scroll animation-slide-in-bottom">
            <div class="info-header">
                <div class="info-header__heading">Information</div>
                <div class="info-header__category">
                    <span class="info-header__category-text">{{ $infoCategory ? $infoCategory->name : 'ALL' }}</span>
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
        $contents = json_decode($infoArticle->contents);
        // TODO: ここは別の箇所で定数として固めるべきかもしれない。考えておく。
        $dynamicTypeKeys = [
            'single_body',
            'single_body_background_on',
            'notice_image',
            'notice_youtube',
            'notice_pdf'
        ]
        ?>
        {{-- dynamic parts類表示 --}}
        @foreach ($contents->dynamic as $dynamic)
            @foreach ($dynamicTypeKeys as $dynamicTypeKey)
                @if (property_exists($dynamic, $dynamicTypeKey ))
                    @includeIf('parts.dynamic.whats_new.' . $dynamicTypeKey, [
                        'dynamicContents' => $dynamic,
                    ])
                @endif
            @endforeach
        @endforeach

        <div class="js-scroll animation-slide-in-bottom">
            <div class="page-navi">
                <div class="page-navi__inner">
                    <?php
                    $infoPreviousArticle = $infoArticle->previous();
                    ?>
                    @if ($infoPreviousArticle)
                        <a class="page-navi__block" href="{{ route('whats_new_show', ['key' => $infoPreviousArticle->permalink]) }}">
                            <div class="page-navi__text">
                                <div class="page-navi__name">前の記事</div>
                                <div class="page-navi__title">
                                    <span>{{$infoPreviousArticle->title}}</span>
                                </div>
                            </div>
                            <div class="page-navi__image">
                                <?php
                                $imageId = firstPartsByKey($infoPreviousArticle->contents, 'notice_image');
                                // TODO: サムネイルのダミー画像を指定するように修正する
                                $imageSrc = 'http://placehold.jp/100x200.png';
                                if (!is_null($imageId)) {
                                    // TODO: サムネイルのサイズに合わせた画像サイズを指定する
                                    $imageSrc = imageUrlById($imageId);
                                }
                                ?>
                                <img class="page-navi__image-img" src="{{ $imageSrc }}" alt="">
                            </div>
                        </a>
                    @endif

                    <?php
                    $infoNextArticle = $infoArticle->next();
                    ?>
                    @if ($infoNextArticle)
                        <a class="page-navi__block" href="{{ route('whats_new_show', ['key' => $infoNextArticle->permalink]) }}">
                            <div class="page-navi__text">
                                <div class="page-navi__name">次の記事</div>
                                <div class="page-navi__title">
                                    <span>{{ $infoNextArticle->title }}</span>
                                </div>
                            </div>
                            <div class="page-navi__image">
                                <?php
                                $imageId = firstPartsByKey($infoNextArticle->contents, 'notice_image');
                                // TODO: サムネイルのダミー画像を指定するように修正する
                                $imageSrc = 'http://placehold.jp/50x50.png';
                                if (!is_null($imageId)) {
                                    // TODO: サムネイルのサイズに合わせた画像サイズを指定する
                                    $imageSrc = imageUrlById($imageId);
                                }
                                ?>
                                <img class="page-navi__image-img" src="{{ $imageSrc }}" alt="">
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </main>


    {{-- Sidebar --}}
    <aside class="layout-base__side">
        <div class="js-scroll animation-slide-in-bottom">
            <div class="side-list">
                <div class="side-list__title">
                    <strong>{{ $infoCategory ? $infoCategory->name : 'お知らせ' }}</strong>の新着
                </div>
                <div class="side-list__list">
                    <ul class="side-link-list">
                        @foreach ($sameInfoCategoryArticles as $infoArticle)
                            <li class="side-link-list__item">
                                <a class="side-link-list__wrap" href="{{ route('whats_new_show', ['key' => $infoArticle->permalink]) }}">
                                    <div class="side-link-list__title">
                                        <span>{{ $infoArticle->title }}</span>
                                    </div>
                                    <div class="side-link-list__image">
                                        <?php
                                        $imageId = firstPartsByKey($contents, 'notice_image');
                                        // TODO: サムネイルのダミー画像を指定するように修正する
                                        $imageSrc = 'http://placehold.jp/30×30.png';
                                        if (!is_null($imageId)) {
                                            // TODO: サムネイルのサイズに合わせた画像サイズを指定する
                                            $imageSrc = imageUrlById($imageId);
                                        }
                                        ?>
                                        <img class="side-link-list__image-img" src="{{ $imageSrc }}" alt="">
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="side-list__link">
                    <!-- mixinを定義-->
                    <div class="link-more">
                        <?php
                            $infoIndexUrl = route('whats_new_index');
                            if($infoCategory){
                                $infoIndexUrl = route('whats_new_index', ['category' => $infoCategory->slug]);
                            }
                        ?>
                        <a class="link-more__link" href="{{ $infoIndexUrl }}">一覧を見る</a>
                    </div>
                </div>
            </div>

            @include('parts.twitter')
        </div>
    </aside>
</div>
@endsection
