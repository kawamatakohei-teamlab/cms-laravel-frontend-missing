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
        $parent_categories_items = Category::where('parent',0)->get();
        $all_categories_items = [];
        foreach ($parent_categories_items as $parent_category) {
            $all_categories_items[$parent_category["slug"]]["display_name"] = $parent_category["name"];
            $child_categories = Category::where('parent',$parent_category["id"])->orderBy('display_no','asc')->get();
            foreach ($child_categories as $child_category) {
                $all_categories_items[$parent_category["slug"]]["children"][$child_category["slug"]]["display_name"] = $child_category["name"];
            }
        }
        return $all_categories_items;
    }

}
