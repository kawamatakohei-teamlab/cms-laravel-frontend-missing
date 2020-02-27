@section('notice_main')
<section class="c-section-article-single c-section-article-single--detail">
<div class="c-section-article-single__in">
    <div class="c-article-header-02">
        <div class="c-article-header-02__info">
            <p class="c-article-header-02__date">{{ $publish_at }}<span class="c-article-header-02__day">（{{ $day_of_week }})</span></p>
            <p class="c-article-header-02__category">{{ $category_name }}</p>
        </div>
        <h1 class="c-article-header-02__title">{{ $title }}</h1>
    </div>
    <div class="c-article-detail">
    <div class="c-article-detail__text">{{$dynamic_body}}</div>
    </div>
    @if($next_article_uri)
        <div class="c-section-article-single__button-next"><a class="c-button" href="{{ $next_article_uri }}/"><span class="c-button__text c-button__icon c-button__icon--icon-arrow">次の記事へ</span></a>
        </div>
    @endif
    </div>
</div>
</section>
@endsection