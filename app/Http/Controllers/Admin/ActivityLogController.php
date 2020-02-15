<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\Http\Controllers\Admin\Controller;

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
        $activities = Activity::with('admin')->latest()->get();

        return view('admin.activities.index',compact('activities'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
