{{-- 概要_枠付き --}}
@if ($dynamicContents)
<div class="rainbow-box">
    <div class="rainbow-box__inner">
        <div class="rainbow-box__text">
            {!! $dynamicContents->overview_frame !!}
        </div>
    </div>
</div>
@endif
