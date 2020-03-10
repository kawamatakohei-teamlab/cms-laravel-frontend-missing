{{-- single_body_background_on --}}
@if ($dynamicContents)
    <div class="js-scroll animation-slide-in-bottom">
        <div class="fill-block">
            {{-- HACK: backend側でtitleというブロックが存在しないため実装できない。 --}}
            {{-- <div class="fill-block__title">
                 ～記念講演会～ 講師：林康夫氏
            </div> --}}
            <div class="fill-block__body">
                <div class="free-block">
                    {!! $dynamicContents->single_body_background_on !!}
                </div>
            </div>
        </div>
    </div>
@endif
