<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/27/2020
 * Time: 5:55 PM
 */

namespace App\Http\View\Composers;


use App\ItemCategory;
use Illuminate\View\View;

class ItemCategoriesComposer
{
    public function compose(View $view)
    {
        $view->with('itemCategories',ItemCategory::orderBy('name','asc')->get());
    }
}
