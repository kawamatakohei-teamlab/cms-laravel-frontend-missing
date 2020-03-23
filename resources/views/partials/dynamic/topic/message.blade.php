{{-- メッセージ --}}
@if ($dynamicContents)
<div class="message">
    <div class="message__header">
        <div class="message__photo">
            <img src="{{ $dynamicContents->message__image }}" alt="">
        </div>
        <div class="message__text">
            <div class="message__title">
                {!! $dynamicContents->message__title !!}
            </div>
            <div class="message__name">
                {!! $dynamicContents->message__name !!}
            </div>
        </div>
    </div>
    <div class="message__comment">
        <p class="message__comment-text">
            {!! $dynamicContents->message !!}
        </p>
    </div>
    <div class="message__introduction">
        {!! $dynamicContents->message__annotation !!}
    </div>
</div>
@endif
