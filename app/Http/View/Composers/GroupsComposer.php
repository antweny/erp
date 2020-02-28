<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/28/2020
 * Time: 2:48 PM
 */

namespace App\Http\View\Composers;


use App\Group;
use Illuminate\View\View;

class GroupsComposer
{
    public function compose(View $view)
    {
        $view->with('groups',Group::getNameID());
    }
}
