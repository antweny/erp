<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 3/2/2020
 * Time: 3:29 PM
 */

namespace App\Http\View\Composers;


use App\Sector;
use Illuminate\View\View;

class SectorsComposer
{
    public function compose(View $view)
    {
        $view->with('sectors',Sector::orderBy('name','asc')->get());
    }
}
