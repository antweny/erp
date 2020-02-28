<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/27/2020
 * Time: 7:03 PM
 */

namespace App\Http\View\Composers;


use App\Employee;
use Illuminate\View\View;

class EmployeesComposer
{
    public function compose(View $view)
    {
        $view->with('employees',Employee::get_full_name_and_id());
    }
}
