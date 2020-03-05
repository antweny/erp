<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/28/2020
 * Time: 6:51 PM
 */

namespace App\Http\View\Composers;

use App\Permission;
use Illuminate\View\View;

class PermissionsComposer
{
    public function compose(View $view)
    {
        $view->with('permissions',Permission::orderBy('name','asc')->get());
    }
}
