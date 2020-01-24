<?php
use Illuminate\Support\Carbon;
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 10/18/2019
 * Time: 5:53 PM
 */


/*
 * Format a datepicker date to mysql format YYYY-mm-dd
 */
function date_to_mysql($date)
{
    return Carbon::parse($date)->format('Y-m-d');
}
/*
 * Format a mysql date to datepicker format  date to mysql format m/d/Y
 */
function mysql_to_date($date)
{
    //ddd($date);
    if($date != null ) {
        return Carbon::parse($date)->format('m/d/Y');
    }
        return null;

}


/*
 * Get month and year from mysql format date
 */
function get_month_and_year($date)
{
    return Carbon::parse($date)->format('M Y');
}

/*
 * Get month and year from mysql format date
 */
function get_day_month_and_year($date)
{
    return Carbon::parse($date)->format('d M, Y');
}

/*
 * Find date difference
 */
function date_difference($start_date,$end_date)
{
    $fromDate = new DateTime($start_date);
    $curDate = new DateTime($end_date);
    $months = $curDate->diff($fromDate);
    if($months->format('%y') > 0) {
        echo $months->format('%y years %m months');
    }
    else {
        echo $months->format('%m months');
    }

}

function calculate_age ($date)
{
    if ($date != null){
        $dob = new DateTime($date);
        $today = new DateTime(date('Y-m-d'));

        return $today->diff($dob);
    }
    else {
        return null;
    }


}