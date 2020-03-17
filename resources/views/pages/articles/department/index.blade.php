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
                    <?php
                        $contents = json_decode($departmentListArticle->contents);
                    ?>
                    <div class="heading-large__text">{{ $contents->headline }}</div>
                </div>
            </h2>
        @endif
        <div class="js-scroll animation-slide-in-bottom">
            <div class="thumbnail-list thumbnail-list--cols3">
                <ul class="thumbnail-list__list">
                    @foreach ($departmentArticles as $departmentArticle)
                        <?php
                            $contents = json_decode($departmentArticle->contents);
                        ?>
                        <li class="thumbnail-list__item">
                            <a class="thumbnail-list__inner" href="{{ $departmentArticle->permalink }}">
                                <div class="thumbnail-list__wrap">
                                    <div class="thumbnail-list__image">
                                        <div class="js-scroll animation-image-ratio">
                                            <?php
                                                // TODO: サムネイルのダミー画像を指定するように修正する
                                                $imageSrc = 'http://placehold.jp/254x150.png';
                                                if (isset($contents->thumbnail_image)) {
                                                    // TODO: サムネイルのサイズに合わせた画像サイズを指定する
                                                    $imageSrc = imageUrlById($contents->thumbnail_image);
                                                }
                                            ?>
                                            <img class="animation-image-ratio__img" src="{{ $imageSrc }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail-list__title">
                                    <span>{{ $departmentArticle->title }}</span>
                                </div>
                                <div class="thumbnail-list__text">{{ $contents->department_description }}</div>
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
                        <?php
                            $contents = json_decode($introductionRelatedPageArticle->contents);
                        ?>
                        <div class="multi-banner__detail">
                            <div class="multi-banner__title">{!! $introductionRelatedPageArticle->title !!}</div>
                            <div class="multi-banner__text">{{ $contents->body }}</div>
                            <div class="multi-banner__button">
                                <a class="button-base button-base--yellow" href="{{ $contents->button_url }}">{{ $contents->button_word }}</a>
                            </div>
                        </div>
                        <div class="multi-banner__visual">
                            <div class="multi-banner__image">
                                <div class="js-scroll animation-image-ratio">
                                    <img class="animation-image-ratio__img" src="{{ $contents->right_image }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="multi-banner__sp-button">
                            <a class="button-base button-base--yellow" href="">{{ $contents->button_word }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
