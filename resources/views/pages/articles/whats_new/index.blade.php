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
                        <li class="filter-list__item">
                            <input class="filter-list__input" id="category0" type="radio" name="category" value="" checked>
                            <label class="filter-list__label" for="category0">ALL</label>
                        </li>
                        @foreach ($infoCategories as $infoCategory)
                            <li class="filter-list__item">
                                <input class="filter-list__input" id="category_{{ $infoCategory->id }}" type="radio" name="category" value="{{ $infoCategory->slug }}">
                                <label class="filter-list__label" for="category1">{{ $infoCategory->name }}</label>
                            </li>
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
                            return $infoCategory->id == $content->notice_type[0];
                        });
                        $info_category_name = $infoCategory ? $infoCategory->name : 'ALL';
                    ?>

                    <li class="information-list__item" data-category="[&quot;{{ $info_category_name }}&quot;]">
                        <a class="information-list__wrap" href="{{ route('whats_new_show', ['key' => $infoArticle->permalink]) }}">
                            <div class="information-list__detail">
                                <div class="information-list__date-block">
                                    <div class="information-list__category">
                                        <div class="information-list__category-text">
                                            {{ $info_category_name }}
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

            {{-- paginate --}}
            {!! $infoArticles->links('pagination.default') !!}
            {{-- / paginate --}}
        </div>
    </div>
</main>
@endsection
