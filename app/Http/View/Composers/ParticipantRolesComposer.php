<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/28/2020
 * Time: 2:49 PM
 */

namespace App\Http\View\Composers;


use App\ParticipantRole;
use Illuminate\View\View;

class ParticipantRolesComposer
{
    public function compose(View $view)
    {
        $view->with('roles',ParticipantRole::getNameID());
    }
}
