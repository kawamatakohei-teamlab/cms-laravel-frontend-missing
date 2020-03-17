{{-- メッセージ --}}
@if ($dynamicContents)
<div class="message">
    <div class="message__header">
        <div class="message__photo">
            <?php
                $imageSrc = config('consts.utils.NO_IMAGE_FILE_PATH');
                if ($dynamicContents->message__image) {
                    $imageSrc = imageUrlById($dynamicContents->message__image);
                }
            ?>
            <img src="{{ $imageSrc }}" alt="">
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
