{{-- 画像と本文 --}}
@if ($dynamicContents)
<div class="float-box">
    <?php
        $isRight = property_exists($dynamicContents, 'image_description__is_right_image');
    ?>

    <div class="float-box__image float-box__image--{{ $isRight ? 'right' : 'left' }}">
        <img src="{{ createImageUrlById($dynamicContents->image_description__image) }}" alt="">
    </div>
    <div class="free-block free-block--topics">
        {!! $dynamicContents->image_description !!}
    </div>
</div>
@endif
