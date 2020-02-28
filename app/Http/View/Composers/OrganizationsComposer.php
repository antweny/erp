<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/28/2020
 * Time: 9:27 AM
 */

namespace App\Http\View\Composers;


use App\Organization;
use Illuminate\View\View;

class OrganizationsComposer
{
    public function compose(View $view)
    {
        $view->with('organizations',Organization::select('name','id','acronym')->orderBy('name','asc')->get());
    }
}
