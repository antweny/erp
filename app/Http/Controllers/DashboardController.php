<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['admin','location','store','event','hrm','individual','organization','support','library']]);
        $this->middleware(['auth:admin','role:superAdmin'],['only'=> ['setting','security']]);
        $this->middleware('auth:employee',['only'=> ['employee']]);
    }

    /*
     * When user with admin Guard login redirwct to.
     */
    public function admin()
    {
        return view('dashboards.admin');
    }

    /*
    * When user with admin Guard login redirwct to.
    */
    public function employee()
    {
        return view('employee.dashboard');
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
    public function individual()
    {
        return view('dashboards.individuals');
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
