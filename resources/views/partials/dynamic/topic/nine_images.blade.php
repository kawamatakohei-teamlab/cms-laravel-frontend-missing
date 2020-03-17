{{-- 画像21枚 --}}
@if ($dynamicContents)

<?php
$galleryId = 'gallery' . Str::random(8);
$galleryImages = [];
?>
<div class="photo-gallery js-gallerylist-open">
    @foreach ($dynamicContents as $key => $value)
        <?php
        $imageSrc = config('consts.utils.NO_IMAGE_FILE_PATH');
        if ($value) {
            $imageSrc = imageUrlById($value);
        }
        array_push($galleryImages, $imageSrc);
        ?>

        <div class="photo-gallery__item" data-gallery-name="{{ $galleryId }}">
            <img class="photo-gallery__image" src="{{ $imageSrc }}" alt="">
        </div>
    @endforeach
</div>

{{-- ギャラリー部分 --}}
@section('topic_show_nine_images_gallery')
<div class="gallery js-gallery" id="{{ $galleryId }}">
    <div class="gallery__inner">
        <div class="gallery__body">
            <div class="gallery__list">
                @foreach ($galleryImages as $src)
                    <div class="gallery__image">
                        <img class="gallery__image-img" src="{{ $src }}" alt="">
                    </div>
                @endforeach
            </div>
            <div class="gallery__controller">
                <button class="gallery__prev js-gallery-prev js-landscape-toggle" type="button">
                    <span></span>
                </button>
                <button class="gallery__next js-gallery-next js-landscape-toggle" type="button">
                    <span></span>
                </button>
                <div class="gallery__page js-landscape-toggle">
                    <span class="gallery__current-number">1</span>&#047;
                    <span class="gallery__total-number">10</span>
                </div>
                <button class="gallery__close js-gallery-close js-landscape-toggle" type="button">
                </button>
            </div>
        </div>
        <div class="gallery__overlay js-gallery-close"></div>
    </div>
</div>
@endsection

@endif
