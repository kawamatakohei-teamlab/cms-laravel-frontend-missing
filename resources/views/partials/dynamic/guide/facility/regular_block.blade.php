{{-- 中 & 小サイズ --}}
<?php
$isDisplaySmall = false;
if (isset($isSmall) && $isSmall) {
    $isDisplaySmall = true;
}
$contents = json_decode($facilityDetailArticle->contents);
?>

<div class="visual-block-column__item">
    <div class="visual-block visual-block--gallery{{ $isDisplaySmall ? '--s' : '' }}">
        <div class="visual-block__visual">
            <div class="js-scroll animation-image-ratio">
                <img class="visual-block__visual-image animation-image-ratio__img" src="{{ imageUrlById($contents->facility_image) }}" alt="">
            </div>
        </div>
        <div class="visual-block__detail">
            @if (!$isDisplaySmall)
                <div class="visual-block__heading">
                    {{ $facilityDetailArticle->title }}
                </div>
            @endif
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
