<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class AssetsController extends Controller
{
    public function stylesheet($name, Request $request)
    {
        $style = Models\Stylesheet::search($name);
        if (is_null($style)) abort(404);
        if (!$style->itemIsPublished()) abort(404);

        $ifModifiedSince = $request->header('if-modified-since');
        $lastModifiedTime = $style->checkIfModified($ifModifiedSince);
        if ($lastModifiedTime === false) {
            $response = response("Not Modified", 304);
        } else {
            $response = response($style->body);
            $response->header('Content-Type', 'text/css');
            $response->header('Last-Modified', $lastModifiedTime);
        }
        return $response;

    }

    public function javascript($name, Request $request)
    {
        $js = Models\Javascript::search($name);
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

}
