<?php

namespace App\Models;

class Stylesheet extends DaisyModelBase
{
    protected $table = 'stylesheets';

    public static function search($nameOrID): ?Stylesheet
    {
        # まずはnameで検索
        $item = Stylesheet::where('name', $nameOrID)->first();
        # nameで検索して、存在しないなら、IDで検索
        if (is_null($item)) {

            $item = Stylesheet::find($nameOrID);
        }
        return $item;
    }


}
