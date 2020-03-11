<?php

namespace App\Http\Controllers;

use App\GenderSeries;
use Illuminate\Http\Request;

class EventDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count_gdss = GenderSeries::select('date')->withCount('participants')->get();



        return view('events.dashboard',compact('count_gdss'));
    }

    //Get GDSS Dates
    function get_gdss_titles()
    {
        $count_gdss = GenderSeries::select('date')->withCount('participants')->get();

         return $count_gdss;

    }
}
