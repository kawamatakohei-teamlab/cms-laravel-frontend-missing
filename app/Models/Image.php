<?php

namespace App\Models;
use GuzzleHttp\Psr7\Request;



class Image extends DaisyModelBase
{
    protected $table = 'images';

    public static function getItemByNameOrId($name_or_id): ?Image
    {
        $item = Image::where('name', $name_or_id)->first();
        if (is_null($item)) $item = Image::find($name_or_id);
        return $item;
    }

    public function getImageThumb($thumb_size)
    {
        $lab_thumber_url = self::createLabThumbUrl($thumb_size);
        // dd(config('lab_thumb.timeout'));
        # TODO:この下のどうしよう.....
        // ログ標準化のためX-Request-IDをヘッダに付与
        // $requestId = self::di()['response']->getHeaders()->get('X-Request-ID');
        // $headers = [
        //     "X-Request-ID:$requestId",
        // ];

        $client = new \GuzzleHttp\Client( [
            'timeout' => config('lab_thumb.endpoint.timeout'),
          ] );
          try {
            $info = $client->get($lab_thumber_url);
          }catch (RequestException $e) {
            abort(500);
        }
        if($info->getStatusCode() != 200){
            abort(500);
        }
        $body = $info->getBody();
        $content_type = $info->getHeaderLine('Content-Type');
        return [ 'body' => $body, 'content_type' => $content_type ];
    }

    public function createLabThumbUrl($thumb_size = false, $action = 'getThumb')
    {
        $thumb_config = config('lab_thumb');
        $image_prefix = config('settings.assets_info.images.prefix');

        $protocol = isset($thumb_config['endpoint']['protocol']) ? $thumb_config['endpoint']['protocol'] : 'http://';
        $port = isset($thumb_config['endpoint']['port']) ? ':' . $thumb_config['endpoint']['port'] : '';
        $host = $thumb_config['endpoint']['host'];
        $noncached = isset($thumb_config['endpoint']['noncached']) ? $thumb_config['endpoint']['noncached'] : false;
        // apiのURL
        $thumberapp = $protocol . $host . $port . '/?';
        $upload_dir = '/' . $image_prefix . '/';
        # TODO: GCPの場合も考えないと
//         gcsの仕様上urlの最初にスラッシュいらないので、gcsの場合削除
//        if (self::$manage_images->publish_strategy == "gcs") {
//            $upload_dir = mb_substr($upload_dir, 0, mb_strpos($upload_dir, '$filename')); // $filenameが入らないように文字列切り取り
//        } else {
//            $upload_dir = '/' . mb_substr($upload_dir, 0, mb_strpos($upload_dir, '$filename')); // $filenameが入らないように文字列切り取り
//        }

        # TODO: basename() や pathinfo() は unicodeファイル名に対して使えないので、しばらく正規表現を使う、後はsetlocale()でpathinfo()を正常にする
        preg_match( "/(.*)(?:\.([^.]+$))/", $this->name, $retArr );
        $storageKey = $upload_dir . $retArr[1] . '/original_' . $this->name;

        // labthumberに投げたいクエリは操作ごとに違う。
        // 現状サムネ欲しいとき（getThumb）とキャッシュ消したいとき（delCache）だけ
        switch ($action) {
            case 'delCache':
                $query = [
                    'delcachedkey' => $storageKey,
                ];
                break;
            case 'getThumb':
            default:
                // sizeのプロパティが存在しなかったらsizeクエリが間違っているからdefaultサイズにしてあげる
                if (!isset($thumb_config['thumbnails'][$thumb_size])){
                    $thumb_size = $thumb_config['default_thumb_size'];
                }
                $thumb_size_info = $thumb_config['thumbnails'][$thumb_size]['size'];

                // この中にクエリをまとめる！
                $query = [
                    'storagekey' => $storageKey,
                    'w' => $thumb_size_info[0],
                    'h' => $thumb_size_info[1],
                    'noncached' => $noncached,
                ];
                if (!empty($thumb_config['thumbnails'][$thumb_size]['options'])) {
                    $query = array_merge($query, $thumb_config['thumbnails'][$thumb_size]['options']);
                }
                break;
        }

        return $thumberapp . http_build_query($query);
    }
}
