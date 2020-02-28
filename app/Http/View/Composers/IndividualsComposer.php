<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/28/2020
 * Time: 9:51 AM
 */

namespace App\Http\View\Composers;


use App\Individual;
use Illuminate\View\View;

class IndividualsComposer
{
    public function compose(View $view)
    {
        $view->with('individuals',Individual::get_name_and_id());
    }
}
