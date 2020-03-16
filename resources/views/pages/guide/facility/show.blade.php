@extends('layouts.common')

@section('main')
<main class="layout-base__main-center">
    <div class="layout-base__inner">
        <h2 class="heading-large-white heading-large-white--low js-scroll">
            <div class="heading-large-white__wrap">
                <div class="heading-large-white__text">
                    {{ $facilityArticle->title }}
                </div>
            </div>
        </h2>
        <div class="js-scroll animation-slide-in-bottom">
            <div class="back-link">
                <a class="back-link__item" href="{{ route('guide_index') }}">
                    大学案内TOP
                </a>
            </div>
        </div>

        <?php
        /**
         * 表示サイズと表示数に合わせてfacilityDetailArticlesを分解
         * TODO: 表示数は固定でいいのかは確認する。
         */
        $displayExtraLargeArticles = $facilityDetailArticles->slice(0,1);
        $displayLargeArticles      = $facilityDetailArticles->slice(1,5);
        $displayRegularArticles    = $facilityDetailArticles->slice(6,4);
        $displaySmallArticles      = $facilityDetailArticles->slice(10,3);
        ?>

        {{-- 特大＆大サイズ --}}
        @foreach ($displayExtraLargeArticles as $facilityDetailArticle)
            {{-- 特大サイズ --}}
            @include('parts.dynamic.guide.facility.extra_large_block', [
                'facilityDetailArticle' => $facilityDetailArticle
            ])
        @endforeach

        <?php $left = true; ?>
        @foreach ($displayLargeArticles as $facilityDetailArticle)
        {{-- 大サイズ　左 --}}
            @include('parts.dynamic.guide.facility.large_block', [
                'facilityDetailArticle' => $facilityDetailArticle,
                'left' => $left
            ])
            <?php $left = !$left; ?>
        @endforeach


        {{-- 中＆小サイズ --}}
        <div class="js-scroll animation-slide-in-bottom">
            <div class="visual-block-column">
                {{-- 中サイズ --}}
                <div class="visual-block-column__list">
                    @foreach ($displayRegularArticles as $facilityDetailArticle)
                        @include('parts.dynamic.guide.facility.regular_block', ['facilityDetailArticle' => $facilityDetailArticle])
                    @endforeach
                </div>

                {{-- 小サイズ --}}
                <div class="visual-block-column__list visual-block-column__list--column3">
                    @foreach ($displaySmallArticles as $facilityDetailArticle)
                        @include('parts.dynamic.guide.facility.small_block', ['facilityDetailArticle' => $facilityDetailArticle])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
