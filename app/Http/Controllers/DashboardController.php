<?php

namespace App\Http\Controllers;

use App\Individual;

class DashboardController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth:admin,employee'],['only'=> ['admin','location','store','event','hrm','organization','support','library','employee']]);
        $this->middleware(['auth:admin','role:superAdmin'],['only'=> ['setting','security']]);
    }

    /*
     * When user with admin Guard login redirwct to.
     */
    public function admin()
    {
        return view('dashboards.dashboard');
    }

    /*
    * When user with admin Guard login redirwct to.
    */
    public function employee()
    {
        return view('dashboards.admin');
    }

  /*
   * When user with admin Guard login redirwct to.
   */
    public function store()
    {
        return view('dashboards.store');
    }

    /*
     * When user with admin Guard login redirwct to.
     */
    public function location()
    {
        return view('dashboards.location');
    }

    /*
    * When user with admin Guard login redirwct to.
    */
    public function event()
    {
        return view('dashboards.event');
    }


    /*
    * Human Resource Management Dashboard.
    */
    public function hrm()
    {
        return view('dashboards.hrm');
    }

    /*
    * System Settngs.
    */
    public function setting()
    {
        return view('dashboards.settings');
    }

    /*
    * System Securities.
    */
    public function security()
    {
        return view('dashboards.security');
    }

    /*
    * System Securities.
    */
    public function organization()
    {
        return view('dashboards.organizations');
    }

    /*
    * System Securities.
    */
    public function support()
    {
        return view('dashboards.supports');
    }

    /*
     * Library Management System.
     */
    public function library()
    {
        return view('dashboards.library');
    }

}
