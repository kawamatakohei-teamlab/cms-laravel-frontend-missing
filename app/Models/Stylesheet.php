<?php

namespace App\Models;

class Stylesheet extends DaisyModelBase
{
    protected $table = 'stylesheets';

    public static function getItemByName($name): ?Stylesheet
    {
        $item = Stylesheet::where('name', $name)->first();
        return $item;
    }


}
