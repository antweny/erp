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
       $gender = $this->get_gender();
        $count_gender = $this->count_gender();
        $age_group = $this->get_age_group();
        $count_age_group = $this->count_age_group();
        return view('individuals.dashboard',compact('gender','count_gender','age_group','count_age_group'));
    }

    //Get User Gender name
    function get_gender ()
    {
        $gender = Individual::select('gender')->groupBy('gender')->orderBy('gender','desc')->pluck('gender');
        return $gender;
    }

    //Count user  by gender
    function count_gender()
    {
        $gender = $this->get_gender();
        if(!empty($gender)){
            foreach ($gender as $sex) {
                $count[] = Individual::where('gender',$sex)->count();
            }
        }
        return json_encode($count);
    }

    //Get Individuals Age Groups
    function get_age_group ()
    {
        $gender = Individual::select('age_group')->groupBy('age_group')->orderBy('age_group','desc')->pluck('age_group');
        return $gender;
    }

    //Count Individual by gender
    function count_age_group()
    {
        $age_groups = $this->get_age_group()->toArray();
        if(!empty($age_groups)){
            foreach ($age_groups as $age_group) {
                $count[] = Individual::where('age_group',$age_group)->count();
            }
        }
        return json_encode($count);
    }

}
