<?php

namespace App\Models\Article;

use App\Geidai\DynamicConverter;
use App\Models\Article;

class Topic extends Article
{
    const CMS_DYNAMIC_DEFINED_KEYS = [
        'overviewFrame'         => 'overview_frame', // 概要_枠付き
        'middleHeading'         => 'middle_heading', // 中見出し
        'singleBody'            => 'single_body', // 本文
        'threeImages'           => 'three_images', // 画像３枚
        'imageDescription'      => 'image_description', // 画像と本文
        'singleImage'           => 'single_image', // 画像
        'singleMovie'           => 'single_movie', // 動画
        'topicsText'            => 'topics_text', // Topicsテキスト
        'message'               => 'message', // メッセージ
        'underlineHeadline28px' => 'underline_headline_28px', // 下線中見出し
        'nineImages'            => 'nine_images', //画像21枚
    ];

    /**
     * convert
     */
    public function convertDynamicData()
    {
        $dynamics = [];

        foreach ($this->dynamic as $dynamic) {
            switch (true) {
                case property_exists($dynamic, self::CMS_DYNAMIC_DEFINED_KEYS['imageDescription']):
                    $dynamic->image_description__image =
                        DynamicConverter::createImageUrlById($dynamic->image_description__image, 'topic-m-image');
                    break;

                case property_exists($dynamic, self::CMS_DYNAMIC_DEFINED_KEYS['singleImage']):
                    $dynamic->single_image =
                        DynamicConverter::createImageUrlById($dynamic->single_image, 'topic-l-image');
                    break;

                case property_exists($dynamic, self::CMS_DYNAMIC_DEFINED_KEYS['singleMovie']):
                    $dynamic->single_movie =
                        DynamicConverter::removeYourubeUrlAndKeepId($dynamic->single_movie);
                    break;

                case property_exists($dynamic, self::CMS_DYNAMIC_DEFINED_KEYS['message']):
                    $dynamic->message__image =
                        DynamicConverter::createImageUrlById($dynamic->message__image, 'topic-s-image');
                    break;

                case property_exists($dynamic, self::CMS_DYNAMIC_DEFINED_KEYS['threeImages']):
                    foreach ($dynamic as $key => $value) {
                        $dynamic->$key =
                            DynamicConverter::createImageUrlById($value, 'topic-s-image');
                    }
                    break;

                case property_exists($dynamic, self::CMS_DYNAMIC_DEFINED_KEYS['nineImages']):
                    foreach ($dynamic as $key => $value) {
                        $dynamic->$key =
                            DynamicConverter::createImageUrlById($value, 'topic-l-image');
                    }
                    break;

                default:
                    break;
            }
            array_push($dynamics, $dynamic);
        }

        return $dynamics;
    }
}
