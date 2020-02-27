@section('dynamic_item')
@foreach($general_top_info['dynamic'] as $dynamic)
{{--調剤薬局でできること一覧--}}
@isset($dynamic->d_what_pharmacy_can_do_top)
<section class="c-section">
    <div class="c-section__in">
        <h2 class="c-title">{{ $dynamic->d_what_pharmacy_can_do_top}}</h2>
        <div class="l-row-content">
            <div class="l-list-column l-list-column--col-03">
                @for ($i = 1; $i <= 3; $i++)
                <?php
                # $p_image = route('assets.image',['thumb_size'=>'original','name'=>$dynamic["d_what_pharmacy_can_do_top__image_$i"]]);
                # TODO: imageのrouteを作る関すを作る
                $p_image = "";
                $p_title = $dynamic->{"d_what_pharmacy_can_do_top__title_$i"};
                $p_body = $dynamic->{"d_what_pharmacy_can_do_top__body_$i"};
                $p_transform_url = trim($dynamic->{"d_what_pharmacy_can_do_top__transform_url_$i"});
                $p_caption = $dynamic->{"d_what_pharmacy_can_do_top__caption_$i"};
                ?>
                @if (!empty($p_title))
                <div class="l-list-column__item">
                    @if(!empty($p_transform_url))
                    <a class="c-card-image-text c-card-image-text--link" href="{{ $p_transform_url }}">
                    @else
                    <div class="c-card-image-text">
                    @endif
                            <figure class="c-card-image-text__image" style="background-image: url({{ $p_image }})"></figure>
                            <p class="c-card-image-text__title">{{ $p_title }}
                                <span class="c-card-image-text__subtitle">{{ $p_caption }}</span>
                            </p>
                            <p class="c-card-image-text__text">{{ $p_body }}</p>
                        @if(!empty($p_transform_url))  </a> @else </div> @endif
                        </div>
                @endif
                @endfor
                </div>
            </div>
            <div class="l-center">
                <a class="c-button" href="/pharmacy">
                    <span class="c-button__text c-button__icon c-button__icon--icon-arrow">すべて見る</span>
                </a>
            </div>
        </div>
</section>
@endisset
    @isset($dynamic->d_convenient_service_top)
        {{--便利なサービス一覧--}}
        <section class="c-section c-section--bg-gray c-section--hidden">
            <h2 class="c-title">{{ $dynamic->d_convenient_service_top }}</h2>
            <div class="l-row-content">
                <div class="c-list-card-slider">
                    <div class="c-list-card-slider__in">
                        <div class="c-list-card-slider__slider">
                            @for ($i = 1; $i <= 4; $i++)
                            <?php
                            $s_image = $dynamic->{"d_convenient_service_top__image_$i"};
                            $s_title = $dynamic->{"d_convenient_service_top__title_$i"};
                            $s_catchphrase = $dynamic->{"d_convenient_service_top__catchphrase_$i"};
                            $s_body = $dynamic->{"d_convenient_service_top__body_$i"};
                            $s_transform_url = $dynamic->{"d_convenient_service_top__transform_url_$i"};
                            $image_url = "";
                            ?>
                            @if(!empty($s_title) && !empty($s_body))
                            <div class="c-list-card__item">
                                <a class="c-card-thumb-01" href="{{ $s_transform_url }}">
                                    <div class="c-card-thumb-01__image-frame">
{{--                                            No Image はまだないので、仮の画像を使う--}}
                                        <figure class="c-card-thumb-01__image" style="background-image: url({{$image_url}})"></figure>
                                    </div>
                                    <div class="c-card-thumb-01__info">
                                        <p class="c-card-thumb-01__title">{{ $s_title }}</p>
                                        <p class="c-card-thumb-01__title-sub">{{ $s_catchphrase }}</p>
                                        <p class="c-card-thumb-01__text">{{ $s_body }}</p>
                                    </div>
                                </a>
                            </div>
                            @endif
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="l-center">
                <a class="c-button" href="/service">
                    <span class="c-button__text c-button__icon c-button__icon--icon-arrow">もっと見る</span>
                </a>
            </div>
        </section>
    @endisset
@endforeach
@endsection