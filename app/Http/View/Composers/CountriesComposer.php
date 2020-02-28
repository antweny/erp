<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/27/2020
 * Time: 11:01 AM
 */

namespace App\Http\View\Composers;
use App\Country;
use Illuminate\View\View;

class CountriesComposer
{
    public function compose(View $view)
    {
        $view->with('countries',Country::orderBy('name','asc')->get());
    }
}
