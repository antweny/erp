<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;

class DashboardController extends Controller
{
    /**
     * Admin index page
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }

}
