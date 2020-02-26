@section('event_list')
<section class="c-section c-section--bg-gray">
    <div class="c-section__in">
        <h2 class="c-title">イベント</h2>
        <ul class="c-list-tab-01 c-list-tab-01--small js-tab-button" data-tab-content=".js-tab-content-02">
            @foreach($event_area_categories as $area_slug => $area)
            <li class="c-list-tab-01__item"><a class="c-list-tab-01__button" href="#" data-category="{{ $area_slug }}">{{ $area['display_name']}}</a></li>
            @endforeach
        </ul>
        <div class="l-row-content">
            <div class="c-tab-content js-tab-content-02">
                @foreach($all_events as $area_slug => $events)
                <div class="c-tab-content__block">
                    @if (!empty($events))
                    <ul class="c-list-event">
                        @foreach($events as $event)
                        <li class="c-list-event__item">
                            <div class="c-box-event-01">
                                <div class="c-box-event-01__in">
                                    <div class="c-box-event-01__upper">
                                        <div class="c-box-event-01__info">
                                            <div class="c-box-event-01__list-icon">
                                                @foreach($event->icon_htmls as $icon_html)
                                                    {!! $icon_html !!}
                                                @endforeach
                                            </div>
                                            <p class="c-box-event-01__title">{!! $event->event_title !!}</p>
                                            <div class="c-box-event-01__datetime">{!! $event->schedule_date !!}</div>
                                            <p class="c-box-event-01__place">{!! $event->event_location !!}</p>
                                        </div>
                                    </div>
                                    <div class="c-box-event-01__lower">
                                        @if(!empty($event->sponsorship))
                                        <div class="c-box-event-01__reserve-info">主催：{!! $event->sponsorship !!}</div>
                                        @endif
                                        @if(!empty($event->cosponsorship))
                                        <div class="c-box-event-01__reserve-info">共催：{!! $event->cosponsorship !!} </div>
                                        @endif
                                        @if(!empty($event->entry_fee))
                                        <div class="c-box-event-01__reserve-info">参加費：{!! $event->entry_fee !!} </div>
                                        @endif
                                        @if(!empty($event->capacity))
                                        <div class="c-box-event-01__reserve-info">定員：{!! $event->capacity !!} </div>
                                        @endif
                                        @if(!empty($event->target))
                                        <div class="c-box-event-01__reserve-info">対象：{!! $event->target !!}</div>
                                        @endif
                                        @if(!empty($event->reservation))
                                        <div class="c-box-event-01__reserve-info">予約：{!! $event->reservation !!}</div>
                                        @endif
                                        <div class="c-box-event-01__detail">{!! $event->description !!}</div>
                                        <?php if (strcmp($event->flyer, '/files/') !== 0): ?>
                                        <a class="c-button c-button--size-small c-button--color-gray c-button--is-block c-box-event-01__button" href="{{ $event->flyer }}" target="_blank">
                                            <span class="c-button__text">チラシを見る</span>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                    @else
                    <p class="c-tab-content__block-empty-text">現在、開催予定のイベントはありません</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        <div class="l-center js-more-button">
            <a class="c-button" href="/event">
                <span class="c-button__text c-button__icon c-button__icon--icon-arrow">すべて見る</span>
            </a>
        </div>
    </div>
</section>
@endsection