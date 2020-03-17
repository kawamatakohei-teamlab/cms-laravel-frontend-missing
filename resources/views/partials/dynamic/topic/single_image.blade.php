{{-- 画像 --}}
@if ($dynamicContents)
<div class="single-photo">
    <?php
        $imageSrc = config('consts.utils.NO_IMAGE_FILE_PATH');
        if ($dynamicContents->single_image) {
            $imageSrc = imageUrlById($dynamicContents->single_image);
        }
    ?>
    <img src="{{ $imageSrc }}" alt="">
</div>
@endif
