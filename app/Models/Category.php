<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends DaisyModelBase
{
    protected $table = 'categories';

    public static function getCategoriesBySlug($slug): ?Category
    {
        $slug_item = Category::where('slug', $slug)->first();
        $category_items = Category::where('parent',$slug_item["id"])->orderBy('display_no','asc')->get();
        return $category_items;
    }

    public static function getAllCategories(): ?Category
    {
        $all_categories_items = Category::all();
        return $all_categories_items;
    }


}
