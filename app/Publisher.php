<?php

namespace App;

class Publisher extends BaseModel
{
    /* -----------------------------------------
     * The attributes that are mass assignable.
     * -----------------------------------------*/
    protected $fillable = ['name','mobile','address','email','website'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'publishers';


}
