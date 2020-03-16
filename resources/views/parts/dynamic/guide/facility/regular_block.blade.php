{{-- 中サイズ --}}
<div class="visual-block-column__item">
    <div class="visual-block visual-block--gallery">
        <div class="visual-block__visual">
            <div class="js-scroll animation-image-ratio">
                {{-- TODO: cms coreを更新しimageUrlByIdを使って画像を表示する --}}
                {{-- imageUrlById($contents->facility_image) --}}
                <img class="visual-block__visual-image animation-image-ratio__img" src="http://placehold.jp/1100x586.png" alt="">
            </div>
        </div>
        <div class="visual-block__detail">
            <div class="visual-block__heading">
                {{ $facilityDetailArticle->title }}
            </div>

            <?php $contents = json_decode($facilityDetailArticle->contents); ?>
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
