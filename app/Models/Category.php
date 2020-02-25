<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends DaisyModelBase
{
    protected $table = 'categories';

    public static function getCategoryBySlug($slug): ?Category
    {
        $slug_item = Category::where('slug', $slug)->first();
        $category_items = Category::where('parent',$slug_item["id"])->orderBy('display_no','asc')->get();
        return $category_items;
    }
}
