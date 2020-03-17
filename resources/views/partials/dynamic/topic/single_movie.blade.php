{{-- 動画 --}}
@if ($dynamicContents)
<?php
    $youtubeMoviekey = removeYourubeUrlAndKeepId($dynamicContents->single_movie);
?>
<div class="movie-block">
    <div class="movie-block__inner">
        <div class="movie-block__movie js-video">
            <input type="hidden" value="{{ $youtubeMoviekey }}" id="movieId">
            <img class="movie-block__cover" src="https://img.youtube.com/vi/{{ $youtubeMoviekey }}/hqdefault.jpg" alt="">
            {{-- IDはyoutube player.jsの利用するため必須 --}}
            <div class="movie-block__video" id="{{ Str::random(8) }}">
            </div>
            <div class="movie-block__movie-play-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38 38">
                    <path fill-rule="nonzero" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 2l23 16.838L12 36z"></path>
                </svg>
            </div>
        </div>
        {{-- TODO: ここを表示するロジックはないけど大丈夫なのか。確認する。 --}}
        {{-- <div class="movie-block__detail">
            <div class="movie-block__title">ゲームクリエイター<span>上田 文人 さん</span></div>
            <div class="movie-block__text">「ゲームの企画というのは、それがおもしろいかどうかは、実際に作って動かしてみるまでわからないことが多いのです」</div>
        </div> --}}
    </div>
</div>
@endif
