<?php

namespace App;


class Department extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'desc', 'sort',
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'departments';


    /* -------------------
    *   Other Functions
    * -------------------*/
    /*
     * Get Name and ID
     */
    static function get_name_and_id()
    {
        $data = Department::select('id','name')->get();
        return $data;
    }

}
