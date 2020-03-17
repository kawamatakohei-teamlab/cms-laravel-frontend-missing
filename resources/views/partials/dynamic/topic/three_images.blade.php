{{-- 画像３枚 --}}
@if ($dynamicContents)
<div class="horizon-photo">
    <div class="horizon-photo__item">
        <?php
        $imageSrc = config('consts.utils.NO_IMAGE_FILE_PATH');
        if ($dynamicContents->three_images) {
            $imageSrc = imageUrlById($dynamicContents->three_images);
        }
        ?>
        <img src="{{ $imageSrc }}" alt="">
    </div>
    <div class="horizon-photo__item">
        <?php
        $imageSrc = config('consts.utils.NO_IMAGE_FILE_PATH');
        if ($dynamicContents->three_images__image_2) {
            $imageSrc = imageUrlById($dynamicContents->three_images__image_2);
        }
        ?>
        <img src="{{ $imageSrc }}" alt="">
    </div>
    <div class="horizon-photo__item">
        <?php
        $imageSrc = config('consts.utils.NO_IMAGE_FILE_PATH');
        if ($dynamicContents->three_images__image_3) {
            $imageSrc = imageUrlById($dynamicContents->three_images__image_3);
        }
        ?>
        <img src="{{ $imageSrc }}" alt="">
    </div>
</div>
@endif
