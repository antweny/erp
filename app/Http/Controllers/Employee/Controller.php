<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller as MainController;

class Controller extends MainController
{
    /**
     * Employee constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:employee']);
    }
}
