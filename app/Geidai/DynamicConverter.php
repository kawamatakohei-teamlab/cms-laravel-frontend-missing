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
}
