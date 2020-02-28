<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/28/2020
 * Time: 6:50 PM
 */

namespace App\Http\View\Composers;

use App\Role;
use Illuminate\View\View;

class RolesComposer
{
    public function compose(View $view)
    {
        $view->with('roles',Role::get());
    }
}
