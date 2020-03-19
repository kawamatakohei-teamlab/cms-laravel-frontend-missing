@extends('layouts.common')

@section('breadcrumb', Breadcrumbs::render('guideFacilityShow', $facilityArticle))

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

        @foreach ($displayExtraLargeArticles as $facilityDetailArticle)
            {{-- 特大サイズ --}}
            @include('partials.dynamic.guide.facility.large_block', [
                'facilityDetailArticle' => $facilityDetailArticle,
                'isExtraLarge' => true
            ])
        @endforeach

        <?php $left = true; ?>
        @foreach ($displayLargeArticles as $facilityDetailArticle)
            {{-- 大サイズ --}}
            @include('partials.dynamic.guide.facility.large_block', [
                'facilityDetailArticle' => $facilityDetailArticle,
                'isLeft' => $left
            ])
            <?php $left = !$left; ?>
        @endforeach


        {{-- 中＆小サイズ --}}
        <div class="js-scroll animation-slide-in-bottom">
            <div class="visual-block-column">
                {{-- 中サイズ --}}
                <div class="visual-block-column__list">
                    @foreach ($displayRegularArticles as $facilityDetailArticle)
                        @include('partials.dynamic.guide.facility.regular_block', [
                            'facilityDetailArticle' => $facilityDetailArticle
                        ])
                    @endforeach
                </div>

                {{-- 小サイズ --}}
                <div class="visual-block-column__list visual-block-column__list--column3">
                    @foreach ($displaySmallArticles as $facilityDetailArticle)
                        @include('partials.dynamic.guide.facility.regular_block', [
                            'facilityDetailArticle' => $facilityDetailArticle,
                            'isSmall' => true
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
