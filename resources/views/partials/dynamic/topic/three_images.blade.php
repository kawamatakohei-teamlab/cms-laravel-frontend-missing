{{-- 画像３枚 --}}
@if ($dynamicContents)
<div class="horizon-photo">
    @foreach ($dynamicContents as $key => $value)
        <div class="horizon-photo__item">
            <img src="{{ createImageUrlById($value) }}" alt="">
        </div>
    @endforeach
</div>
@endif
