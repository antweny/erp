<?php

namespace App\Http\Controllers;

use App\Individual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndividualDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $name_gender = $this->get_individual_gender();
        $count_gender = $this->count_individual_gender();
        return view('individuals.dashboard',compact('name_gender','count_gender'));
    }

    //Get Individual Gender name
    function get_individual_gender ()
    {
        $gender = Individual::select('gender')->groupBy('gender')->pluck('gender');
        return $gender;
    }

    //Count Individual by gender
    function count_individual_gender()
    {
        $gender = $this->get_individual_gender()->toArray();
        if(!empty($gender)){
            foreach ($gender as $sex) {
                $count[] = Individual::where('gender',$sex)->count();
            }
        }
        //dd($count);
        return json_encode($count);
        //return $count;
    }


}
