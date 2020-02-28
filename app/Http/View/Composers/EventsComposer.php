<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/28/2020
 * Time: 2:46 PM
 */

namespace App\Http\View\Composers;


use App\Event;
use Illuminate\View\View;

class EventsComposer
{
    public function compose(View $view)
    {
        $view->with('events',Event::get_name_and_id());
    }
}
