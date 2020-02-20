<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stylesheet;
use App\javascript;

class AssetsController extends Controller
{
    public function stylesheet($name,Request $request) {
        // header('Last-Modified: 2019-10-17 11:09:33');
        // header('Last-Modified: Fri Jan 01 2010 00:00:00 GMT');
        // dd($request);
        // dd($request->header('if-modified-since'));
        $style = Stylesheet::where('name', $name)->first();

        //テストコード：擬似的
        header('Last-Modified: Thu, 17 Oct 2019 11:09:33 GMT');
        $modifiedSince = $request->header('if-modified-since');


        if(is_null($style)) {
            $style = Stylesheet::find($name);
        }
        if(is_null($style)) {
            return redirect('/404');
        }
        $publish_at = $style->pulish_at ? new \DateTime($style->pulish_at) : false; 
        $expire_at = $style->expire_at ? new \DateTime($file->expire_at) : false;

        if(($publish_at || $expire_at) && !$this->isPublished($publish_at,$expire_at)){
            return redirect('/404');
        }
        
        if($style){
            // 最終更新日を取得する
            $updatedAt = $this->generateLastModified($style->updated_at);
            // dd($updatedAt);
            if($modifiedSince == $updatedAt) {
                $response = response("Not Modified",304);
                dd($response);
            }
            // response('Hello World', 200);
            // $response = response(200)->header('Content-Type', 'text/plain');;
            // dd($response);
        }

        dd($style->body);
        // return $style->body;
        // return view('welcome');
    }

    public function javascript($name) {
        $js = Javascript::where('name',$name)->first();
        if(is_null($js)) {
            $js = javascript::find($name);
        }
        if(is_null($js)) {
            return redirect('/404');
        }
        dd($js->body);
        return $js->body;
        // return view('welcome');
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
