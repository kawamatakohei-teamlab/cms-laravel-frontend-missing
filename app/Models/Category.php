<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Category extends Model
{
    protected $table = 'categories';
    const POSITION_PARENT_CATEGORY_SLUG = 'position';
    const DEPARTMENT_PARENT_CATEGORY_SLUG = 'department';

    const INFO_PARENT_CATEGORY_SLUG = 'info_category';

    public static function findBySlug($slug)
    {
        return Category::where('slug', $slug)->first();
    }

    public static function getCategoriesBySlug($slug): ?Collection
    {
        $slug_item = Category::where('slug', $slug)->first();
        $category_items = Category::where('parent',$slug_item["id"])->orderBy('display_no','asc')->get();
        return $category_items;
    }
}
