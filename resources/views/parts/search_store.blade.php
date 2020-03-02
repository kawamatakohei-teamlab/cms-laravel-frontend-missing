@section('search_store')
{{--店舗検索部分--}}
<section class="c-section c-section--bg-gray only-pc">
    <h2 class="c-title">店舗検索</h2>
    <div class="section-search-store__in">
        <div class="c-search-store">
            <form method="GET" action="/tenpo">
                <div class="c-search-store__form">
                    <div class="c-select-area js-custom-pulldown c-search-store__form-area">
                        <div class="c-select-area__text" data-text="">エリア</div>
                        <input class="c-select-area__input" data-input="" type="hidden" value="" name="area"/>
                        <div class="c-select-area__list" data-pulldown="">
                            @foreach($area_list as $code=>$name)
                            <div class="c-select-area__item" data-value="{{ $code }}">{{ $name }}</div>
                            @endforeach
                        </div>
                    </div>
                    <input class="c-search-store__form-keyword" type="text" value="" placeholder="キーワード" name="keyword">
                    <button class="c-search-store__form-button"></button>
                </div>
                <div class="c-search-filter">
                    <div class="c-search-filter__condition">
                        <a class="c-search-filter__condition-link" href="javascript:void(0);">その他条件で検索</a>
                    </div>
                    <div class="c-search-filter__modal">
                        <div class="c-search-filter__modal-in">
                            <div class="c-search-filter__option">
                                @foreach( $checkbox_lists as $checkbox_list)
                                <div class="c-search-filter__option-item">
                                    <label class="c-checkbox">
                                        <input class="c-checkbox__input" type="checkbox" name="{{ $checkbox_list['name'] }}" />
                                        <span class="c-checkbox__text">{{ $checkbox_list['label'] }}</span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="c-search-filter__modal-button">
                                <a class="c-button c-button--size-small c-button--is-block c-search-filter__button-submit" href="#">
                                    <span class="c-button__text">決定</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
{{--    これはスマホ向けの部分なので、とりあえずいらない--}}
{{--    <section class="c-section c-section--no-padding-bottom only-sp">--}}
{{--        <div class="c-section__in">--}}
{{--            <h2 class="c-title">お近くの店舗</h2>--}}
{{--            <div class="l-row-content">--}}
{{--                <div class="c-nearby-search js-sp-search">--}}
{{--                    <div class="c-nearby-search__text">位置情報の使用許可がされませんでした。<br>位置情報をオンにするとお近くの店舗が表示されます。</div>--}}
{{--                    <div class="c-search-store">--}}
{{--                        <form method="GET" action="/tenpo">--}}
{{--                            <div class="c-search-store__form">--}}
{{--                                <div class="c-select-area js-custom-pulldown c-search-store__form-area">--}}
{{--                                    <div class="c-select-area__text" data-text="">エリア</div>--}}
{{--                                    <input class="c-select-area__input" data-input="" type="hidden" value="" name="area"/>--}}
{{--                                    <div class="c-select-area__list" data-pulldown="">--}}
{{--                                        {% for code, name in area_list %}--}}
{{--                                        <div class="c-select-area__item" data-value="{{ code }}">{{ name }}</div>--}}
{{--                                        {% endfor %}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <input class="c-search-store__form-keyword" type="text" value="" placeholder="キーワード" name="keyword">--}}
{{--                                <button class="c-search-store__form-button"></button>--}}
{{--                            </div>--}}
{{--                            <div class="c-search-filter">--}}
{{--                                <div class="c-search-filter__modal">--}}
{{--                                    <div class="c-search-filter__modal-in">--}}
{{--                                        <div class="c-search-filter__option">--}}
{{--                                            <div class="c-search-filter__option-item">--}}
{{--                                                {% for checkbox_list in checkbox_lists %}--}}
{{--                                                <label class="c-checkbox">--}}
{{--                                                    <input class="c-checkbox__input" type="checkbox" name="{{ checkbox_list['name'] }}"/>--}}
{{--                                                    <span class="c-checkbox__text">{{ checkbox_list['label'] }}</span>--}}
{{--                                                </label>--}}
{{--                                                {% endfor %}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="c-search-filter__modal-button">--}}
{{--                                            <a class="c-button c-button--size-small c-button--is-block c-search-filter__button-submit" href="#">--}}
{{--                                                <span class="c-button__text">決定</span>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="c-nearby-map js-sp-map">--}}
{{--                    <div class="c-nearby-map__map js-google-map" data-pin-image="{{ nd.map_pin }}"></div>--}}
{{--                    <a class="c-nearby-map__google-button js-google-map-link" href="" target="_blank">地図を開く</a>--}}
{{--                    <div class="c-nearby-map__info">--}}
{{--                        <ul class="js-map-info-list">--}}
{{--                            {% for store in stores %}--}}
{{--                            <li class="js-map-info-item">--}}
{{--                                <a class="c-card-map-info js-map-info" href="/tenpo/{{ store.permalink }}" data-lat="{{ store.map_latitude }}" data-lng="{{ store.map_longitude }}" data-google-map-link="https://www.google.com/maps?q={{ store.map_latitude }},{{ store.map_longitude }}">--}}
{{--                                    <div class="c-card-map-info__title-wrap">--}}
{{--                                        <div class="c-card-map-info__title js-title">{{ store.title }}</div>--}}
{{--                                        <div class="c-card-map-info__range js-distance"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="c-card-map-info__open-time">営業時間：{{ store.opening_hours }}</div>--}}
{{--                                    <div class="c-card-map-info__open-date">定休日：{{ store.regular_holiday }}</div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            {% endfor %}--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="l-center js-sp-button">--}}
{{--                <a class="c-button" href="/tenpo">--}}
{{--                    <span class="c-button__text c-button__icon c-button__icon--icon-arrow">他の店舗を探す</span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection