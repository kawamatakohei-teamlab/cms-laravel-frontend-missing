@extends('layouts.common')

@section('breadcrumb', Breadcrumbs::render('teacherIndex'))

@section('main')
<main class="layout-base__main-center">
    <div class="layout-base__inner">
        <h2 class="heading-large-white heading-large-white--low js-scroll">
            <div class="heading-large-white__wrap">
                <div class="heading-large-white__text">教員一覧</div>
            </div>
        </h2>
        <div class="js-scroll animation-slide-in-bottom">
            <div class="filter-list">
                <div class="filter-list__selected js-filter-list-open">ALL</div>
                <div class="filter-list__title">すべてのカテゴリ</div>
                <div class="filter-list__wrap">
                    <ul class="filter-list__list js-filter-name-list">
                        <div class="li filter-list__item">
                            <input class="filter-list__input" id="category0" type="radio" name="category" value="" checked>
                            <label class="filter-list__label" for="category0">ALL</label>
                        </div>
                        @foreach ($departmentCategories as $departmentCategory)
                            <div class="li filter-list__item">
                                <input class="filter-list__input" id="category{{$loop->iteration}}" type="radio" name="category" value="{{ $departmentCategory->id }}">
                                <label class="filter-list__label" for="category{{$loop->iteration}}">{{ $departmentCategory->name }}</label>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
            @foreach ($positionCategories as $positionCategory)
                @foreach ($teacherArticles as $teacherArticle)
                    <?php
                        $contents = json_decode($teacherArticle->contents);
                    ?>
                    @if ($contents->position == $positionCategory->id)
                        <h3 class="heading-middle">
                            <div class="heading-middle__text">{{ $positionCategory->name }}</div>
                        </h3>
                        <div class="name-list">
                            @if ($contents->url)
                                <div class="name-list__item" data-category="[&quot;{{ implode('&quot;,&quot;', $contents->department) }}&quot;]">
                                    <a class="name-list__wrap" href="{{ $contents->url }}">
                                        <div class="link-external">
                                            <span class="name-list__text">{{ $teacherArticle->title }}</span>
                                        </div>
                                    </a>
                                </div>
                            @else
                                <div class="name-list__item" data-category="[&quot;{{ implode('&quot;,&quot;', $contents->department) }}&quot;]">
                                    <div class="name-list__wrap">
                                        <div class="name-list__text"><span>{{ $teacherArticle->title }}</span></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
</main>
@endsection
