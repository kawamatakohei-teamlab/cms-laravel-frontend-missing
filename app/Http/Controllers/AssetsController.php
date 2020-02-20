<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Stylesheet;
use App\Http\Models\javascript;
use App\Http\Models\material;

class AssetsController extends Controller
{
    public function stylesheet($name,Request $request) {
        $style = Stylesheet::where('name', $name)->first();

        $modifiedSince = $request->header('if-modified-since');

        if(is_null($style)) {
            $style = Stylesheet::find($name);
        }
        if(is_null($style)) {
            abort('404');
        }
        $publish_at = $style->pulish_at ? new \DateTime($style->pulish_at) : false; 
        $expire_at = $style->expire_at ? new \DateTime($style->expire_at) : false;

        if(($publish_at || $expire_at) && !$this->isPublished($publish_at,$expire_at)){
            abort('404');
        }
        
        if($style){
            // 最終更新日を取得する
            $updatedAt = $this->generateLastModified($style->updated_at);
            if($modifiedSince == $updatedAt) {
                $response = response("Not Modified",304);
            }else{
                $response = response($style->body)->header('Content-Type',  'text/css');
                header('Last-Modified: '. $updatedAt);
            }
            return $response;
        }else{
            abort('404');
        }
    }

    public function javascript($name,Request $request) {
        $js = Javascript::where('name',$name)->first();

        $modifiedSince = $request->header('if-modified-since');
        
        if(is_null($js)) {
            $js = javascript::find($name);
        }
        if(is_null($js)) {
            abort('404');
        }
        $publish_at = $js->pulish_at ? new \DateTime($js->pulish_at) : false; 
        $expire_at = $js->expire_at ? new \DateTime($js->expire_at) : false;

        if(($publish_at || $expire_at) && !$this->isPublished($publish_at,$expire_at)){
            abort('404');
        }

        if($js){
            // 最終更新日を取得する
            $updatedAt = $this->generateLastModified($js->updated_at);
            if($modifiedSince == $updatedAt) {
                $response = response("Not Modified",304);
            }else{
                $response = response($js->body)->header('Content-Type',  'text/javascript');
                header('Last-Modified: '. $updatedAt);
            }
            return $response;
        }else{
            abort('404');
        }
    }

    public function material($name,Request $request) {
        $name = str_replace(['&', '?'], ['%26', '%3F'],urldecode($name));
        $material = Material::where('name',$name)->first();

        // $modifiedSince = $request->header('if-modified-since');

         if(is_null($material)){
             $material = material::find($material);
         }
         if(is_null($material)){
             abort(404);
         }
         $publish_at = $material->pulish_at ? new \DateTime($material->pulish_at) : false; 
         $expire_at = $material->expire_at ? new \DateTime($material->expire_at) : false;

         if(($publish_at || $expire_at) && !$this->isPublished($publish_at,$expire_at)){
            abort('404');
        }


    }

    public static function isPublished($publish,$expire) {
        $today = date("Y-m-d H:i");
        if($publish && $expire){
            //両方送られてきた場合は両方チェック
            if ($publish->format("Y-m-d H:i") <= $today && $today < $expire->format("Y-m-d H:i")){
                return true;
            }
        }elseif($publish && !$expire){
            //publishのみの場合は公開日より先になっていればtrueを返す
            if($today >= $publish->format("Y-m-d H:i")){
            return true;
          }
        }elseif(!$publish && $expire){
            //expireのみの場合は終了日より前になっていればtrueを返す
            if($today < $expire->format("Y-m-d H:i")){
              return true;
            }
        }
        return false;
    }

    public static function generateLastModified($updatedAt)
    {
        $dt = new \Datetime($updatedAt);
        // NOTE: RFC 1123 の書式らしいが、JSTで動かしたら一部のブラウザでは勝手にGMTに…
        // しかもタイムゾーン考慮してない値になっていたのでGMT変換するようにしました。
        $dt->setTimezone(new \DateTimeZone('GMT'));
        $lastModified = $dt->format('D, d M Y H:i:s T');
        return $lastModified;
    }
}
