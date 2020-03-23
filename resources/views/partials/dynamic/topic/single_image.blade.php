{{-- 画像 --}}
@if ($dynamicContents)
<div class="single-photo">
    <img src="{{ createImageUrlById($dynamicContents->single_image) }}" alt="">
</div>
@endif
