@extends('layouts.common')

@section('breadcrumb', Breadcrumbs::render('departmentIndex'))

@section('main')
<main class="layout-base__main-center">
    <div class="layout-base__inner">
        @if($departmentListArticle)
            <h2 class="heading-large-white heading-large-white--low js-scroll">
                <div class="heading-large-white__wrap">
                    <div class="heading-large-white__text">{{ $departmentListArticle->title }}</div>
                </div>
            </h2>
            <h2 class="heading-large heading-large--low js-scroll">
                <div class="heading-large__wrap">
                    <div class="heading-large__text">{{ $departmentListArticle->headline }}</div>
                </div>
            </h2>
        @endif
        <div class="js-scroll animation-slide-in-bottom">
            <div class="thumbnail-list thumbnail-list--cols3">
                <ul class="thumbnail-list__list">
                    @foreach ($departmentArticles as $departmentArticle)
                        <li class="thumbnail-list__item">
                            <a class="thumbnail-list__inner" href="{{ $departmentArticle->permalink }}">
                                <div class="thumbnail-list__wrap">
                                    <div class="thumbnail-list__image">
                                        <div class="js-scroll animation-image-ratio">
                                            <?php
                                                // TODO: サムネイルのダミー画像を指定するように修正する
                                                $imageSrc = 'http://placehold.jp/254x150.png';
                                                if (isset($departmentArticle->thumbnail_image)) {
                                                    // TODO: サムネイルのサイズに合わせた画像サイズを指定する
                                                    $imageSrc = imageUrlById($departmentArticle->thumbnail_image);
                                                }
                                            ?>
                                            <img class="animation-image-ratio__img" src="{{ $imageSrc }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail-list__title">
                                    <span>{{ $departmentArticle->title }}</span>
                                </div>
                                <div class="thumbnail-list__text">{{ $departmentArticle->department_description }}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if($introductionRelatedPageArticle)
            <div class="js-scroll animation-slide-in-bottom">
                <div class="multi-banner">
                    <div class="multi-banner__inner">
                        <div class="multi-banner__detail">
                            <div class="multi-banner__title">{!! $introductionRelatedPageArticle->title !!}</div>
                            <div class="multi-banner__text">{{ $introductionRelatedPageArticle->body }}</div>
                            <div class="multi-banner__button">
                                <a class="button-base button-base--yellow" href="{{ $introductionRelatedPageArticle->button_url }}">{{ $introductionRelatedPageArticle->button_word }}</a>
                            </div>
                        </div>
                        <div class="multi-banner__visual">
                            <div class="multi-banner__image">
                                <div class="js-scroll animation-image-ratio">
                                    <img class="animation-image-ratio__img" src="{{ $introductionRelatedPageArticle->right_image }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="multi-banner__sp-button">
                            <a class="button-base button-base--yellow" href="">{{ $introductionRelatedPageArticle->button_word }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
