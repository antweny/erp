<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/27/2020
 * Time: 11:39 AM
 */

namespace App\Http\View\Composers;


use App\District;
use Illuminate\View\View;

class DistrictsComposer
{
    public function compose(View $view)
    {
        $view->with('districts',District::orderBy('name','asc')->get());
    }
}
