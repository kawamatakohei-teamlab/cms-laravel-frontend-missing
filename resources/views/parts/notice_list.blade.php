@section('notice_list')
<section class="c-section">
    <div class="c-section__in">
        <h2 class="c-title">お知らせ</h2>
        <div class="c-tab-content js-tab-content-03">
            <div class="c-tab-content__block">
                <div class="l-row-content">
                    <div class="c-list-article c-list-article--first-no-border">
                    @foreach ($notices as $notice)
                        <div class="c-list-article__item">
                            <div class="c-list-article__head">
                                <div class="c-list-article__date">{{ $notice->publish_at }}</div>
                                <div class="c-list-article__category">{{ $notice_name }}</div>
                            </div>
                            <div class="c-list-article__info">
                                <a class="c-list-article__link" href="/info/{{$notice->permalink}}/">{{ $notice->title }}</a>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="l-center js-more-button">
            <a class="c-button" href="/info/">
                <span class="c-button__text c-button__icon c-button__icon--icon-arrow">すべて見る</span>
            </a>
        </div>
    </div>
</section>
@endsection