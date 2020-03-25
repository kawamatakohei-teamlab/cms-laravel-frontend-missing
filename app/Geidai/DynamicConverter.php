<?php

namespace App\Geidai;

class DynamicConverter
{
    /**
     * 受け取った画像idをもとに画像のURLを生成する。渡された値がnullだった場合デフォルト画像を返す。
     * TODO: core側にあったほうが良いかもしれない
     * @param string|integer|null $id
     * @return string|null
     */
    static public function createImageUrlById($id = null, $thumber_size = 'original')
    {
        $imageUrl = config('consts.utils.NO_IMAGE_FILE_PATH');
        if ($id) {
            $imageUrl = imageUrlById($id, $thumber_size);
        }
        return $imageUrl;
    }

    /**
     * youtube動画項目にyoutubeのドメインごと貼られていた場合はURL部分をトリミングする。
     * ex)
     * https://youtu.be/xxxxxx
     * https://www.youtube.com/watch?v=xxxxxx
     */
    static public function removeYourubeUrlAndKeepId($youtubeUrl)
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
}
