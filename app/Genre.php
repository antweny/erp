<?php

namespace App;


use PHPUnit\Util\RegularExpressionTest;

class Genre extends BaseModel
{
    /* -----------------------------------------
    * The attributes that are mass assignable.
    * ----------------------------------------- */
    protected $fillable = ['name','desc','type'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'genres';




    /*
     * Accessors to fomart the database data
     */
    public function getGenreTypeAttribute()
    {
        switch ($this->type)
        {
            case 'F':
                return 'Fiction';
                break;
            case 'NF':
                return 'Non-Fiction';
                break;
            default:
                return '';
                break;
        }
    }
}
