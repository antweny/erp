<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/27/2020
 * Time: 5:54 PM
 */

namespace App\Http\View\Composers;

use App\ItemUnit;
use Illuminate\View\View;

class ItemUnitsComposer
{
    public function compose(View $view)
    {
        $view->with('itemUnits',ItemUnit::orderBy('name','asc')->get());
    }
}
