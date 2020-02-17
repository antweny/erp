<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller as MainController;

class Controller extends MainController
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:admin']);
    }
}
