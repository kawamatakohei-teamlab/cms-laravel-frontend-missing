<?php

namespace App\Models;

class Javascript extends DaisyModelBase
{
    protected $table = 'javascripts';

    public static function search($nameOrID): ?Javascript
    {
        # まずはnameで検索
        $item = Javascript::where('name', $nameOrID)->first();
        # nameで検索して、存在しないなら、IDで検索
        if (is_null($item)) {

            $item = Javascript::find($nameOrID);
        }
        return $item;
    }

}
