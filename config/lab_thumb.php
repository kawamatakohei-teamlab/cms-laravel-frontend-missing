<?php
switch (env('APP_ENV')) {
    case 'local':
        # TODO: add assets type: S3 or GCP?とりあえずGCPを使う案件あんまりないかも？
        $endpoint = [
            'host' => env('THUMBER_HOST'),
            'port' => env('THUMBER_PORT'),
            'path' => '',
            'timeout' => '20',
        ];
        break;
    case 'dev':
    case 'development':
        $endpoint = [
            'host' => env('THUMBER_HOST'),
            'port' => env('THUMBER_PORT'),
            'path' => '',
            'timeout' => '20',
        ];
        break;
    case 'staging':
        $endpoint = [
            'host' => env('THUMBER_HOST'),
            'port' => env('THUMBER_PORT'),
            'path' => '',
            'timeout' => '20',
        ];
        break;
    case 'production':
        $endpoint = [
            'host' => env('THUMBER_HOST'),
            'port' => env('THUMBER_PORT'),
            'path' => '',
            'timeout' => '20',
        ];
        break;
}
$default_thumb_size = 'admin';
$thumbnails = [
    'original' => [
        'key' => 'original',
        'size' => []
    ],
    'admin' => [
        'key' => 'admin',
        'size' => [400, 400]
    ],
    'pc-ss' => [
        'key' => 'pc-ss',
        'size' => [300, null]
    ],
    'pc-s' => [
        'key' => 'pc-s',
        'size' => [640, null]
    ],
    'pc-m' => [
        'key' => 'pc-m',
        'size' => [1300, null]
    ],
    'pc-l' => [
        'key' => 'pc-l',
        'size' => [2000, null]
    ],
    'pc-ll-slender' => [
        'key' => 'pc-ll-slender',
        'size' => [2400, null]
    ],
    'pc-ll-fat' => [
        'key' => 'pc-ll-fat',
        'size' => [1000, 1000]
    ],
    'sp-s' => [
        'key' => 'sp-s',
        'size' => [400, null]
    ],
    'sp-m' => [
        'key' => 'sp-m',
        'size' => [800, null]
    ],
    'sp-l' => [
        'key' => 'sp-l',
        'size' => [1200, null]
    ],
    'sp-ll-slender' => [
        'key' => 'sp-ll-slender',
        'size' => [640, null]
    ],
    'sp-ll-fat' => [
        'key' => 'sp-ll-fat',
        'size' => [null, 1500]
    ],
    /**
     * 以下、大阪芸大用の画像サイズ
     */
    'topic-s-image' => [
        'key' => 'topic-s-image',
        'size' => [180, 180]
    ],
    'topic-m-image' => [
        'key' => 'topic-m-image',
        'size' => [640, null]
    ],
    'topic-l-image' => [
        'key' => 'topic-l-image',
        'size' => [1960, null]
    ],
];
return [
    'thumbnails' => $thumbnails,
    'endpoint' => $endpoint,
    'default_thumb_size' => $default_thumb_size,
];
