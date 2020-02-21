<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class AssetsController extends Controller
{
    public function stylesheet($name, Request $request)
    {
        $css = Models\Stylesheet::getItemByName($name);
        if (is_null($css)) abort(404);
        if (!$css->itemIsPublished()) abort(404);

        $ifModifiedSince = $request->header('if-modified-since');
        $lastModifiedTime = $css->checkIfModified($ifModifiedSince);
        if ($lastModifiedTime === false) {
            $response = response("Not Modified", 304);
        } else {
            $response = response($css->body);
            $response->header('Content-Type', 'text/css');
            $response->header('Last-Modified', $lastModifiedTime);
        }
        return $response;

    }

    public function javascript($name, Request $request)
    {
        $js = Models\Javascript::getItemByName($name);
        if (is_null($js)) abort(404);
        if (!$js->itemIsPublished()) abort(404);

        $ifModifiedSince = $request->header('if-modified-since');
        $lastModifiedTime = $js->checkIfModified($ifModifiedSince);
        if ($lastModifiedTime === false) {
            $response = response("Not Modified", 304);
        } else {
            $response = response($js->body);
            $response->header('Content-Type', 'text/javascript');
            $response->header('Last-Modified', $lastModifiedTime);
        }
        return $response;

    }


    public function material($name, Request $request)
    {
        $name = str_replace(['&', '?'], ['%26', '%3F'], urldecode($name));
        $material = Models\Material::getItemByName($name);
        if (is_null($material)) abort(404);
        if (!$material->itemIsPublished()) abort(404);

        $ifModifiedSince = $request->header('if-modified-since');
        $lastModifiedTime = $material->checkIfModified($ifModifiedSince);
        if ($lastModifiedTime === false) {
            $response = response("Not Modified", 304);
        } else {
            $response = $material->getMaterialObjectAsResponse();
            $response->headers->set('Last-Modified', $lastModifiedTime);
        }
        return $response;
    }

    public function file($name,Request $request)
    {
        $name = str_replace(['&', '?'], ['%26', '%3F'],urldecode($name));
        $file = Models\File::getItemByName($name);
        if (is_null($file)) abort(404);
        if (!$file->itemIsPublished()) abort(404);

        $ifModifiedSince = $request->header('if-modified-since');
        $lastModifiedTime = $file->checkIfModified($ifModifiedSince);
        if ($lastModifiedTime === false) {
            $response = response("Not Modified", 304);
        } else {
            $response = $file->getFileObjectAsResponse();
            $response->headers->set('Last-Modified', $lastModifiedTime);
        }
        return $response;
    }

    public function image($size,$name,Request $request){
        // urlエンコードされて来るのでdecodeしないとdbの検索できない
        // 何故か削除されてたけど削除すると日本語とか404になるので必要です。
        $name = preg_match('/\?/',$name) ? str_replace(['&','?'], ['%26', '%3F'],urldecode($name)): urldecode($name);
        if(empty($name) || empty($size) ) abort('404');
        $image = Models\Image::getItemByNameOrId($name);
        if (is_null($image)) abort('404');
        if (!$image->itemIsPublished()) abort(404);

        $ifModifiedSince = $request->header('if-modified-since');
        $lastModifiedTime = $image->checkIfModified($ifModifiedSince);
        if ($lastModifiedTime === false) {
            $response = response("Not Modified", 304);
        } else {
            $object = $image->getImageThumb($size);
            $response = response($object["body"]);
            $response->header('Content-Type',$object["content_type"]);
            $response->header('Last-Modified', $lastModifiedTime);
        }
        return  $response;
    }

}
