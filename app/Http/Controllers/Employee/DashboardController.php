<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Employee\Controller;

class DashboardController extends Controller
{
    /**
     * Employee index page
     */
    public function index ()
    {
        return view('employee.dashboard');
    }
}
