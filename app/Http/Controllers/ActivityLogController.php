<?php

namespace App\Http\Controllers;

use App\Activity;

class ActivityLogController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:admin','role:superAdmin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $activities = Activity::with('admin')->latest()->get();
            return view('activity.logs.index',compact('activities'));
        }
        catch (\Exception $e) {
            return abort(404);
        }
    }

}
