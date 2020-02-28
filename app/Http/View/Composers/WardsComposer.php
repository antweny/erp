<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/27/2020
 * Time: 11:39 AM
 */

namespace App\Http\View\Composers;


use App\Ward;
use Illuminate\View\View;

class WardsComposer
{
    public function compose(View $view)
    {
        $view->with('wards',Ward::orderBy('name','asc')->get());
    }
}
