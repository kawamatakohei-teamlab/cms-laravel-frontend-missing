@section('main_top')
<div class="c-hero">
    <div class="c-hero__in">
        <div class="c-hero__slider">
            @for ($i = 1; $i <= 5; $i++)
                @if (!empty($general_top_info["main_image_pc_$i"]) ||  !empty($general_top_info["main_image_sp_$i"]))
                    <div class="c-hero__item">
                        <div class="c-hero__image" data-pc-image="{{ route('assets.image',['thumb_size'=>'original','name'=>$general_top_info["main_image_pc_$i"]]) }}" data-sp-image="{{ route('assets.image',['thumb_size'=>'original','name'=>$general_top_info["main_image_sp_$i"]]) }}">
                            <div class="c-hero__info">
                                <div class="c-hero__info-in">
                                    <div class="c-hero__title-wrap">
                                        @if (!empty($general_top_info["title_$i"]))
                                        <p class="c-hero__title">{{$general_top_info["title_$i"]}}</p>
                                        @endif
                                        @if (!empty($general_top_info["caption_$i"]))
                                        <p class="c-hero__text">{{$general_top_info["caption_$i"] }}</p>
                                        @endif
                                    </div>
                                    @if (!empty($general_top_info["transform_url_$i"]) ||  !empty($general_top_info["button_text$i"]))
                                    <a class="c-button c-hero__button" href="{{ $general_top_info["transform_url_$i"]}}" >
                                        <span class="c-button__text c-button__icon c-button__icon--icon-arrow">{{ $general_top_info["button_text_$i"] }}</span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @endfor
        </div>
    </div>
</div>

<div class="c-hero-news">
    <div class="c-hero-news__in">
        <div class="c-hero-news__item">
            <div class="c-hero-news__date">{{ $important_notice->updated_at }}（NEED TO COMPLETE WEEK FUNCTION）<span class="c-hero-news__pipe">|</span><br class="only-sp"> {{ $important_notice->title }}</div>
            <div class="c-hero-news__detail"><a class="c-hero-news__link" href="{{ $important_notice->transform_url }}">{{ $important_notice['description'] }}</a></div>
        </div>
    </div>
</div>

@endsection