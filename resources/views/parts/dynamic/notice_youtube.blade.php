{{-- notice_youtube --}}
@if ($dynamicContents)
    {{--
        youtubeのドメインごと貼られていた場合はURL部分をトリミングする。
        ex)
        https://youtu.be/xxxxxx
        https://www.youtube.com/watch?v=xxxxxx
     --}}

    {{-- TODO: 他のパーツでも利用するようならHelperなどに移して共通化する --}}
    <?php
    $youtubeNonKeyUrls = [
        'https://youtu.be/',
        'https://www.youtube.com/watch?v='
    ];
    $youtubeMovieKey = $dynamicContents->notice_youtube;
    foreach ($youtubeNonKeyUrls as $url) {
        if(strpos($youtubeMovieKey, $url) !== false){
            $youtubeMovieKey = str_replace($url, '', $youtubeMovieKey);
        }
    }
    ?>

    <div class="js-scroll animation-slide-in-bottom">
        <div class="movie-block">
            <div class="movie-block__inner">
                <div class="movie-block__movie js-video">
                    <input type="hidden" value="{{ $youtubeMovieKey }}" id="movieId">
                    {{-- HACK: 初期画像はどうやって用意する？ --}}
                    <img class="movie-block__cover" src="https://img.youtube.com/vi/{{ $youtubeMovieKey }}/hqdefault.jpg" alt="">
                    {{-- IDはyoutube player.jsの利用するため必須 --}}
                    <div class="movie-block__video" id="{{ Str::random(8) }}">
                    </div>

                    <div class="movie-block__movie-play-button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38 38">
                            <path fill-rule="nonzero" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 2l23 16.838L12 36z"></path>
                        </svg>
                    </div>
                </div>
                {{-- HACK: 要確認。この箇所notice_youtubeに定義されていない --}}
{{--
                <div class="movie-block__detail">
                    <div class="movie-block__title">ゲームクリエイター<span>上田 文人 さん</span>
                </div>
                <div class="movie-block__text">
                    「ゲームの企画というのは、それがおもしろいかどうかは、実際に作って動かしてみるまでわからないことが多いのです」
                </div>
 --}}
            </div>
        </div>
    </div>
@endif
