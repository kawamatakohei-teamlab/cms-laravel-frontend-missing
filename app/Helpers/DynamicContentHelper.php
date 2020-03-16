<?php

// TODO: CmsCoreに取り込むかもしれない。
// 取り込んだ場合はこちらを削除する。

/**
 * 動的コンテンツ内の最初の$key要素を取得し返却。なければnullを返す。
 * @param string|object $contents
 * @param string $key
 * @return array|null
 */
function firstPartsByKey($contents, $key)
{
    $result = null;
    if (is_string($contents)) {
        $contents = json_decode($contents);
    }

    foreach ($contents->dynamic as $dynamic) {
        if(property_exists($dynamic, $key)){
            $result = $dynamic->$key;
            break;
        }
    }

    return $result;
}
