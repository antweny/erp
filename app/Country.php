<?php

namespace App;

use Illuminate\Support\Str;

class Country extends BaseModel
{

    /* -----------------------------------------
   * The attributes that are mass assignable.
   * -----------------------------------------*/
    protected $fillable = ['name','desc','code'];


    /* ------------------------------------------
     * Log all activities performed on the model
     * ------------------------------------------*/
    protected static $logName = 'countries';


    /* -------------------
     * Route model binding
     * -------------------*/
    public function getRouteKeyName ()
    {
        return 'slug';
    }


    /* -----------------
    * Mutator Functions
    * -----------------*/
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
        $this->attributes['slug'] = Str::slug($value,'-');
    }


    /* -------------------
     *   Other Functions
     * -------------------*/

    /*
     * Get Name and ID
     */
    static function get_name_and_id()
    {
        $data = Country::select('id','name')->get();
        return $data;
    }

}
