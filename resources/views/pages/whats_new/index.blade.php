@extends('layouts.common')

@section('breadcrumb', Breadcrumbs::render('whatsNewIndex'))

@section('main')
<main class="layout-base__main-center">
    <div class="layout-base__inner">
        <!-- mixinを定義-->
        <h2 class="heading-large heading-large--low js-scroll">
            <div class="heading-large__wrap">
            <div class="heading-large__text">Information</div>
            </div>
        </h2>
        <div class="js-scroll animation-slide-in-bottom">
            <div class="filter-list">
                <div class="filter-list__selected js-filter-list-open">ALL</div>
                <div class="filter-list__title">すべてのカテゴリ</div>
                <div class="filter-list__wrap">
                    <ul class="filter-list__list js-filter-information-list">
                        {{-- TODO: カテゴリーがリンクではなく、動的な切り替え --}}
                        <li class="filter-list__item">
                            <input class="filter-list__input" id="category0" type="radio" name="category" value="{{ $filterCategory ? $filterCategory->slug : '' }}" {{ $filterCategory ? '' : 'checked' }}>
                            <label class="filter-list__label" for="category0">ALL</label>
                        </li>
                        @foreach ($infoCategories as $infoCategory)
                            <li class="filter-list__item">
                                <input class="filter-list__input" id="category{{ $infoCategory->id }}" type="radio" name="category" value="{{ $infoCategory->slug }}" {{ $filterCategory && $filterCategory->id == $infoCategory->id ? 'checked' : ''}}>
                                <a href="{{ route('whats_new_index', ['category' => $infoCategory->slug]) }}">
                                    <label class="filter-list__label" for="category{{ $infoCategory->id }}">{{ $infoCategory->name }}</label>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <ul class="information-list">
                @foreach ($infoArticles as $infoArticle)
                    <?php
                        $contents = json_decode($infoArticle->contents);
                        $infoCategory = $infoCategories->first(function ($infoCategory) use ($contents){
                            return $infoCategory->id == $contents->notice_type[0];
                        });
                        $infoCategorySlug = $infoCategory ? $infoCategory->slug : 'all';
                        $infoCategoryName = $infoCategory ? $infoCategory->name : 'ALL';
                    ?>

                    <li class="information-list__item" data-category="[&quot;{{ $infoCategorySlug }}&quot;]">
                        <a class="information-list__wrap" href="{{ route('whats_new_show', ['key' => $infoArticle->permalink]) }}">
                            <div class="information-list__detail">
                                <div class="information-list__date-block">
                                    <div class="information-list__category">
                                        <div class="information-list__category-text">
                                            {{ $infoCategoryName }}
                                        </div>
                                    </div>
                                    <div class="information-list__date">
                                        {{ $infoArticle->publish_at->format('Y.m.d') }}
                                    </div>
                                </div>
                                <div class="information-list__title">
                                    <span>{{ $infoArticle->title }}</span>
                                </div>
                            </div>
                            <div class="information-list__image">
                                <?php
                                    $noticeImageContents = firstPartsByCmsDefinedKey($contents, 'notice_image');
                                    // TODO: サムネイルのダミー画像を指定するように修正する
                                    $imageSrc = 'http://placehold.jp/300x200.png';
                                    if (isset($noticeImageContents)) {
                                        // TODO: サムネイルのサイズに合わせた画像サイズを指定する
                                        $imageSrc = imageUrlById($noticeImageContents->notice_image);
                                    }
                                ?>
                                <img class="information-list__image-img" src="{{ $imageSrc }}" alt="">
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- paginate --}}
            {!! $infoArticles->links('pagination.default') !!}
            {{-- / paginate --}}
        </div>
    </div>
</main>
@endsection
