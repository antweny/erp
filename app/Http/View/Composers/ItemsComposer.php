<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/27/2020
 * Time: 6:20 PM
 */

namespace App\Http\View\Composers;

use App\Item;
use Illuminate\View\View;

class ItemsComposer
{

    public function compose(View $view)
    {
        $view->with('items',Item::select('name','id')->orderBy('name','asc')->get());
    }
}
