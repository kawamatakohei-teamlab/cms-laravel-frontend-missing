<?php

namespace App\Models;

class Javascript extends DaisyModelBase
{
    protected $table = 'javascripts';

    public static function getItemByName($name): ?Javascript
    {
        $item = Javascript::where('name', $name)->first();
        return $item;
    }

}
