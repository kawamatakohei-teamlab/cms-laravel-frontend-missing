<?php

// TODO: CmsCoreに取り込むかもしれない。
// 取り込んだ場合はこちらを削除する。

/**
 * 動的コンテンツ内の最初の$cmsDefinedKey要素を取得し返却。なければnullを返す。
 * @param string|object $contents
 * @param string $cmsDefinedKey
 * @return array|null
 */
function firstPartsByCmsDefinedKey($contents, $cmsDefinedKey)
{
    $result = null;

    foreach ($contents->dynamic as $dynamic) {
        if(property_exists($dynamic, $cmsDefinedKey)){
            $result = $dynamic;
            break;
        }
    }

    return $result;
}

/**
 * 受け取った画像idをもとに画像のURLを生成する。渡された値がnullだった場合デフォルト画像を返す。
 * @param string|integer|null $id
 * @return string|null
 */
function createImageUrlById($id = null)
{
    $imageUrl = config('consts.utils.NO_IMAGE_FILE_PATH');
    if ($id) {
        $imageUrl = imageUrlById($id);
    }
    return $imageUrl;
}
