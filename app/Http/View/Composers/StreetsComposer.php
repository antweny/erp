<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/27/2020
 * Time: 11:40 AM
 */

namespace App\Http\View\Composers;


use App\Street;
use Illuminate\View\View;

class StreetsComposer
{
    public function compose(View $view)
    {
        $view->with('streets',Street::orderBy('name','asc')->get());
    }
}
