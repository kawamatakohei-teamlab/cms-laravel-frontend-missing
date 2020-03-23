{{-- 画像３枚 --}}
@if ($dynamicContents)
<div class="horizon-photo">
    @foreach ($dynamicContents as $value)
        <div class="horizon-photo__item">
            <img src="{{ $value }}" alt="">
        </div>
    @endforeach
</div>
@endif
