@section('notice_list_main')
<section class="c-section-article-list">
    <div class="c-section-article-list__in">
        <div class="l-article-column">
            <div class="c-article-filter-head">
                <div class="c-article-filter-head__title">
                    <h1 class="c-title c-article-filter-head__text">お知らせ</h1>
                </div>
                <div class="c-article-filter-head__filter">
                    <div class="c-select-year js-custom-pulldown">
                        <div class="c-select-year__text" data-text="">{{$search_year}}年度</div>
                        <input class="c-select-year__input" data-input="" type="hidden" value="{{$search_year}}"/>
                        <div class="c-select-year__pulldown" data-pulldown="">
                        @foreach ($years as $year)
                        <a class="c-select-year__item" data-value="{{ $year }}" href="/info/?year={{ $year }}&category=notification">{{ $year }}年度</a>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-tab-content js-tab-content-01">
            <div class="c-tab-content__block">
                <div class="l-row-content">
                <ul class="c-list-article c-list-article--first-no-border js-list-card-thumb-0">
                @foreach ($notices as $notice)
                        <li class="c-list-article__item">
                            <div class="c-list-article__head">
                                <div class="c-list-article__date">{{ $notice["publish_at"] }}</div>
                                <div class="c-list-article__category">お知らせ</div>
                            </div>
                            <div class="c-list-article__info"><a class="c-list-article__link" href="/info/{{$notice["permalink"]}}/">{{ $notice["title"] }}</a></div>
                        </li>
                 @endforeach
                </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection