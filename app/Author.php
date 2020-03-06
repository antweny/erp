<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends BaseModel
{
    /* -----------------------------------------
     * The attributes that are mass assignable.
     * -----------------------------------------*/
    protected $fillable = ['name','mobile','address','email','website'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'authors';
}
