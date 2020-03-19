{{-- 特大 or 大サイズ --}}
<?php
$class = 'right';
if(isset($isExtraLarge) && $isExtraLarge) {
    $class = 'center';
} else if (isset($isLeft) && $isLeft) {
    $class = 'left';
}
?>

<div class="js-scroll animation-slide-in-bottom">
    <div class="visual-block visual-block--{{ $class }}">
        <div class="visual-block__visual">
            <picture class="js-scroll animation-image-ratio">
                <source srcset="/assets/images/_dummy-img01.png" media="(min-width: 768px)">
                <source srcset="/assets/images/_dummy-img02.png" media="(max-width: 767px)">
                <img class="visual-block__visual-image animation-image-ratio__img" src="{{ imageUrlById($facilityDetailArticle->facility_image) }}" alt="">
            </picture>
        </div>
        <div class="visual-block__detail">
            <div class="visual-block__heading">
                {!! $facilityDetailArticle->title !!}
            </div>
            <div class="visual-block__description">
                <div class="visual-block__description-title">
                    {{ $facilityDetailArticle->facility_headline }}
                </div>
                <div class="visual-block__description-text">
                    {{ $facilityDetailArticle->facility_description }}
                </div>
                @if (!empty($facilityDetailArticle->facility_detail_related_url))
                    <div class="visual-block__link">
                        <a class="link link--arrow" href="{{ route('guide_facility_detail_show', ['permalink' => $facilityDetailArticle->facility_detail_related_url]) }}">
                            詳細を見る
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
