<?php

namespace App;


class Department extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'desc',
    ];


    /**
     * Log all activities performed on the model
     */
    protected static $logName = 'departments';


}
