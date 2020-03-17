{{-- 特大 or 大サイズ --}}
<?php
$class = 'right';
if(isset($extraLarge) && $extraLarge) {
    $class = 'center';
} else if (isset($left) && $left) {
    $class = 'left';
}

$contents = json_decode($facilityDetailArticle->contents);
?>

<div class="js-scroll animation-slide-in-bottom">
    <div class="visual-block visual-block--{{ $class }}">
        <div class="visual-block__visual">
            <picture class="js-scroll animation-image-ratio">
                <source srcset="/assets/images/_dummy-img01.png" media="(min-width: 768px)">
                <source srcset="/assets/images/_dummy-img02.png" media="(max-width: 767px)">
                <img class="visual-block__visual-image animation-image-ratio__img" src="{{ imageUrlById($contents->facility_image) }}" alt="">
            </picture>
        </div>
        <div class="visual-block__detail">
            <div class="visual-block__heading">
                {!! $facilityDetailArticle->title !!}
            </div>
            <div class="visual-block__description">
                <div class="visual-block__description-title">
                    {{ $contents->facility_headline }}
                </div>
                <div class="visual-block__description-text">
                    {{ $contents->facility_description }}
                </div>
                @if (!empty($contents->facility_detail_related_url))
                    <div class="visual-block__link">
                        <a class="link link--arrow" href="{{ route('guide_facility_detail_show', ['permalink' => $contents->facility_detail_related_url]) }}">
                            詳細を見る
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
