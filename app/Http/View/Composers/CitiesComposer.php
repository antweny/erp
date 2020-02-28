<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/27/2020
 * Time: 11:39 AM
 */

namespace App\Http\View\Composers;

use App\City;
use Illuminate\View\View;

class CitiesComposer
{
    public function compose(View $view)
    {
        $view->with('cities',City::orderBy('name','asc')->get());
    }
}
