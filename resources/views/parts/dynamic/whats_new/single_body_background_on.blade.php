{{-- single_body_background_on --}}
@if ($dynamicContents)
    <div class="js-scroll animation-slide-in-bottom">
        <div class="fill-block">
            <div class="fill-block__body">
                <div class="free-block">
                    {!! $dynamicContents->single_body_background_on !!}
                </div>
            </div>
        </div>
    </div>
@endif
