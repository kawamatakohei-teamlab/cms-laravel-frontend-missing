<?php

namespace App\Models;

use App\CmsCore\Models\Category as CmsCoreCategory;

class Category extends CmsCoreCategory
{
    const POSITION_PARENT_CATEGORY_SLUG = 'position';
    const DEPARTMENT_PARENT_CATEGORY_SLUG = 'department';

    const INFO_PARENT_CATEGORY_SLUG = 'info_category';
}
