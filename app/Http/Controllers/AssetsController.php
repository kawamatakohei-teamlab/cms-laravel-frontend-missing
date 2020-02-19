<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stylesheet;
use App\javascript;

class AssetsController extends Controller
{
    public function stylesheet($name) {
        $style = Stylesheet::where('name', $name)->first();
        if(is_null($style)) {
            $style = Stylesheet::find($name);
        }
        if(is_null($style)) {
            abort('404');
        }

        $publish_at = !is_null($style->pulish_at) ? new \DateTime($style->pulish_at) : false; 
        $expire_at = !is_null($style->expire_at) ? new \DateTime($file->expire_at) : false;
        if(($publish_at || $expire_at) && !$this->isPublished($publish_at,$expire_at)){
            $this->dispatcher->forward(array('controller' => 'index', 'action' => 'route404'));
          }
        dd( new \DateTime($style->pulish_at));

        // dd($style->body);
        return $style->body;
        // return view('welcome');
    }

    public function javascript($name) {
        $js = Javascript::where('name',$name)->first();
        if(is_null($js)) {
            $js = javascript::find($name);
        }
        if(is_null($js)) {
            abort('404');
        }
        dd($js->body);
        return $js->body;
        // return view('welcome');
    }

    public static function isPublished($publish_at,$expire_at) {
    }
}
