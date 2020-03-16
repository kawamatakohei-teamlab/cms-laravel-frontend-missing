@extends('layouts.common')

@section('main')
<main class="layout-base__main-center">
    <div class="layout-base__inner">
        <h2 class="heading-large-white heading-large-white--low js-scroll">
            <div class="heading-large-white__wrap">
                <div class="heading-large-white__text">施設案内</div>
            </div>
        </h2>
        <div class="js-scroll animation-slide-in-bottom">
            <div class="back-link">
                <a class="back-link__item" href="">大学案内TOP</a>
            </div>
        </div>


        {{-- 特大＆大サイズ --}}
        <?php $left = true; ?>
        @foreach ($facilityDetailArticles as $facilityDetailArticle)
            @if ($loop->iteration <= 1)
                {{-- 特大サイズ --}}
                @include('parts.dynamic.guide.facility.extra_large_block', ['facilityDetailArticle' => $facilityDetailArticle])
            @elseif ($loop->iteration <= 6)
                @if ($left)
                    {{-- 大サイズ　左 --}}
                    @include('parts.dynamic.guide.facility.left_large_block', ['facilityDetailArticle' => $facilityDetailArticle])
                @else
                    {{-- 大サイズ　右 --}}
                    @include('parts.dynamic.guide.facility.right_large_block', ['facilityDetailArticle' => $facilityDetailArticle])
                @endif
                <?php $left = !$left; ?>
            @endif
        @endforeach


        {{-- 中＆小サイズ --}}
        <div class="js-scroll animation-slide-in-bottom">
            <div class="visual-block-column">
                {{-- 中サイズ --}}
                <div class="visual-block-column__list">
                    @foreach ($facilityDetailArticles as $facilityDetailArticle)
                        @if ($loop->iteration <= 6)
                            @continue
                        @endif

                        @if ($loop->iteration <= 10)
                            @include('parts.dynamic.guide.facility.regular_block', ['facilityDetailArticle' => $facilityDetailArticle])
                        @else
                            @break
                        @endif
                    @endforeach
                </div>

                {{-- 小サイズ --}}
                <div class="visual-block-column__list visual-block-column__list--column3">
                    @foreach ($facilityDetailArticles as $facilityDetailArticle)
                        @if ($loop->iteration <= 10)
                            @continue
                        @endif

                        @include('parts.dynamic.guide.facility.small_block', ['facilityDetailArticle' => $facilityDetailArticle])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
