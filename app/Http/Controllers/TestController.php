<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stylesheet;
use App\javascript;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $s3_disk = Storage::disk('s3');
        $file = $s3_disk->get("materials/company-info_sp@2x.png");
        $mimeType = $s3_disk->mimeType("materials/company-info_sp@2x.png");
        dd($mimeType);
        return "Hello";
    }

}
