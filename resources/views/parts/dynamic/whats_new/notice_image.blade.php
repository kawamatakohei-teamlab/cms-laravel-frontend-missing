{{-- notice_image --}}
{{-- HACK: backend側で画像アップロードの不具合により未確認。 --}}
@if ($dynamicContents)
    {{-- type: image --}}
    <div class="js-scroll animation-slide-in-bottom">
        <figure class="image-block">
            <div class="image-block__image">
                <img class="image-block__image-img" src="http://placehold.jp/640x320.png">
                <div class="image-block__button">
                    <button class="button-plus js-gallery-open" type="button" data-gallery-name="modal-image-block"></button>
                </div>
            </div>
        </figure>
    </div>

    {{-- HACK: ギャラリー機能とはなにか確認する。 --}}
    <div class="gallery js-gallery" id="modal-image-block">
        <div class="gallery__inner">
            <div class="gallery__body">
                <div class="gallery__list">
                    <div class="gallery__image">
                        <img class="gallery__image-img" src="http://placehold.jp/440x400.png" alt="">
                    </div>
                </div>
                <div class="gallery__controller">
                <button class="gallery__prev js-gallery-prev js-landscape-toggle" type="button"><span></span></button>
                <button class="gallery__next js-gallery-next js-landscape-toggle" type="button"><span></span></button>
                <div class="gallery__page js-landscape-toggle">
                    <span class="gallery__current-number">1</span>&#047;<span class="gallery__total-number">1</span>
                </div>
                <button class="gallery__close js-gallery-close js-landscape-toggle" type="button"></button>
            </div>
            </div>
            <div class="gallery__overlay js-gallery-close"></div>
        </div>
    </div>
@endif
