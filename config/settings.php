<?php
switch (env('APP_ENV')) {
    case 'local':
        # TODO: add assets type: S3 or GCP?とりあえずGCPを使う案件あんまりないかも
        $assets_info = [
            'materials' => [
                'prefix' => 'materials',
            ],
            'files' => [
                'prefix' => 'files',
            ],
            'images' => [
                'prefix' => 'images/$filename',
            ]
        ];
        break;
    case 'dev':
    case 'development':
        $assets_info = [
            'materials' => [
                'prefix' => 'materials',
            ],
            'files' => [
                'prefix' => 'files',
            ],
            'images' => [
                'prefix' => 'images/$filename',
            ]
        ];
        break;
    case 'staging':
        $assets_info = [
            'materials' => [
                'prefix' => 'materials',
            ],
            'files' => [
                'prefix' => 'files',
            ],
            'images' => [
                'prefix' => 'images/$filename',
            ]
        ];
        break;
    case 'production':
        $assets_info = [
            'materials' => [
                'prefix' => 'materials',
            ],
            'files' => [
                'prefix' => 'files',
            ],
            'images' => [
                'prefix' => 'images/$filename',
            ]
        ];
        break;
}
return [
    "assets_info" => $assets_info
];
