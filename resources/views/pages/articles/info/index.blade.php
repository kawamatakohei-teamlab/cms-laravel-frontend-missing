@extends('layouts.common')

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
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category0" type="radio" name="category" value="" checked>
                            <label class="filter-list__label" for="category0">ALL</label>
                        </div>
                        @foreach ($infoCategories as $infoCategory)
                            <div class="li filter-list__item">
                                <input class="filter-list__input" id="category_{{ $infoCategory->id }}" type="radio" name="category" value="{{ $infoCategory->slug }}">
                                <label class="filter-list__label" for="category1">{{ $infoCategory->name }}</label>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>

            <ul class="information-list">
                @foreach ($infoArticles as $infoArticle)
                    <?php
                        // HACK: json_decodeした際のデータがおかしいので、保存時の処理を確かめる。
                        $content = json_decode($infoArticle->contents);
                        $infoCategory = $infoCategories->first(function ($infoCategory) use ($content){
                            // var_dump(json_decode($content->notice_type)[0]);
                            return $infoCategory->id == 40;//$content['notice_type'];
                        });
                    ?>

                    <li class="information-list__item" data-category="[&quot;入試&quot;]">
                        <a class="information-list__wrap" href="">
                            <div class="information-list__detail">
                                <div class="information-list__date-block">
                                    <div class="information-list__category">
                                        <div class="information-list__category-text">
                                            {{ $infoCategory ? $infoCategory->name : 'ALL' }}
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
                                <img class="information-list__image-img" src="http://placehold.jp/300x200.png" alt="">
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="pagination">
                <button class="pagination__arrow pagination__arrow--prev" type="button"><span></span></button>
                <button class="pagination__item pagination__item--first" type="button">1</button>
                <div class="pagination__omit"><span></span></div>
                <button class="pagination__item" type="button">3</button>
                <button class="pagination__item" type="button">4</button>
                <div class="pagination__item pagination__item--current">5</div>
                <button class="pagination__item" type="button">6</button>
                <button class="pagination__item" type="button">7</button>
                <div class="pagination__omit"><span></span></div>
                <button class="pagination__item pagination__item--last" type="button">18</button>
                <button class="pagination__arrow pagination__arrow--next" type="button"><span></span></button>
            </div>
        </div>
    </div>
</main>
@endsection
