<?php

namespace App\CmsCore\Controllers;

use Illuminate\Http\Request;
use App\CmsCore\Models;

class AssetsController extends Controller
{
    public function stylesheet($name, Request $request)
    {
        $css = Models\Stylesheet::getItemByName($name);
        if (is_null($css)) abort(404,"[StylesheetController] Stylesheet name: $name not exists in DB.");
        if (!$css->itemIsPublished()) abort(404, "[StylesheetController] Stylesheet name: $name not published.");

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
        if (is_null($js))  abort(404,"[JavascriptController] Javascript name: $name not exists in DB.");
        if (!$js->itemIsPublished()) abort(404,"[JavascriptController] Javascript name: $name not published.");

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
        if (is_null($material)) abort(404, "[MaterialController] Material name: $name not exists in DB.");
        if (!$material->itemIsPublished()) abort(404, "[MaterialController] Material name: $name not published.");

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

    public function file(Request $request, $name_or_id)
    {
        $route_name = request()->route()->getName();
        # ID かつ ファイル名でファイルを取得
        if ($route_name == 'assets.file.name') {
            $name = str_replace(['&', '?'], ['%26', '%3F'], urldecode($name_or_id));
            $file = Models\File::getItemByName($name);
        }elseif($route_name == 'assets.file.id'){
            if (!is_numeric($name_or_id)) abort(404,'File id needs int.');
            $file = Models\File::getItemById($name_or_id);
        };
        if (is_null($file)) abort(404, "[FileController] File : $name_or_id not exists in DB.");
        if (!$file->itemIsPublished()) abort(404, "[FileController] File : $name_or_id not published.");

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

    public function image(Request $request,$size, $name_or_id)
    {
        $route_name = request()->route()->getName();
        if ($route_name == 'assets.image.name') {
            // urlエンコードされて来るのでdecodeしないとdbの検索できない
            // 何故か削除されてたけど削除すると日本語とか404になるので必要です。
            $name = preg_match('/\?/', $name_or_id) ? str_replace(['&', '?'], ['%26', '%3F'], urldecode($name_or_id)) : urldecode($name_or_id);
            if (empty($name) || empty($size)) abort(422,"[ImageController] Image name: $name, thumber size: $size in query parameter may be empty.");
            $image = Models\Image::getItemByName($name);
        }elseif($route_name == 'assets.image.id'){
            if (!is_numeric($name_or_id)) abort(404,'Image id needs int.');
            $image = Models\Image::getItemById($name_or_id);
        }

        if (is_null($image)) abort(404,"[ImageController] Image: $name_or_id not exists in DB.");
        if (!$image->itemIsPublished()) abort(404, "[ImageController] Image: $name_or_id not published");

        $ifModifiedSince = $request->header('if-modified-since');
        $lastModifiedTime = $image->checkIfModified($ifModifiedSince);
        if ($lastModifiedTime === false) {
            $response = response("Not Modified", 304);
        } else {
            $object = $image->getImageThumb($size);
            $response = response($object["body"]);
            $response->header('Content-Type', $object["content_type"]);
            $response->header('Last-Modified', $lastModifiedTime);
        }
        return $response;
    }

}
