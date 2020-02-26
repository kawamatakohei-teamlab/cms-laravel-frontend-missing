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

    public static function getAllCategories()
    {
        $all_categories_items = Category::all();
        $categories_items = [];
        foreach($all_categories_items as $category_items) {
            if($category_items["parent"] == 0) {
                $categories_items[$category_items["slug"]]["display_name"] = $category_items["name"];
                $categories_items[$category_items["slug"]]["id"] = $category_items["id"];
                $categories_items[$category_items["slug"]]["children"] = Category::getChildren($category_items["id"],$all_categories_items);
            }
        }
        return $categories_items;
    }

    public static function getChildren($parent_id,$all_items) {
        $children = [];
        foreach ($all_items as $item) {
            if ($item["parent"] == $parent_id){
                $children[$item["slug"]]["display_name"] = $item["name"];
                $children[$item["slug"]]["id"] = $item["id"];
                $children[$item["slug"]]["children"] = Category::getChildren($item["id"],$all_items);
            }
        }
        if(!$children == []) return $children;;
    }
}
