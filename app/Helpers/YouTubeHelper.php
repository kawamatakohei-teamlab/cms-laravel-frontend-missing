<?php

/**
 * youtube動画項目にyoutubeのドメインごと貼られていた場合はURL部分をトリミングする。
 * ex)
 * https://youtu.be/xxxxxx
 * https://www.youtube.com/watch?v=xxxxxx
 */
function removeYourubeUrlAndKeepId($youtubeUrl)
{
    $youtubeNonKeyUrls = [
        'https://youtu.be/',
        'https://www.youtube.com/watch?v='
    ];

    foreach ($youtubeNonKeyUrls as $url) {
        if(strpos($youtubeUrl, $url) !== false){
            $youtubeUrl = str_replace($url, '', $youtubeUrl);
        }
    }

    return $youtubeUrl;
}
