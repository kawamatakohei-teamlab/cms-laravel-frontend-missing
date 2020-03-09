{{-- single_body --}}
@if ($dynamicContents)
    <div class="js-scroll animation-slide-in-bottom">
        <div class="free-block">
            {!! $dynamicContents->single_body !!}
        </div>
    </div>
@endif
