<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends DaisyModelBase
{
    protected $table = 'images';

    public static function getItemByName($name): ?Image
    {
        $item = Image::where('name', $name)->first();
        return $item;
    }
}
